<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Payment;
use Endroid\QrCode\QrCode;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.payments.index')->only('index');
        $this->middleware('can:admin.payments.create')->only(['create', 'store']);
        $this->middleware('can:admin.payments.edit')->only(['edit', 'update']);
        $this->middleware('can:admin.payments.destroy')->only('destroy');
        $this->middleware('can:admin.payments.show')->only('show');
        $this->middleware('can:admin.payments.pdf')->only(['pdfIndividual']);
        $this->middleware('can:admin.payments.report.pdf')->only(['pdfReport']);
    }

    public function index()
    {
        $payments = Payment::with(['patient', 'doctor'])->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        $patients = Patient::orderBy('names')->get();
        $doctors = Doctor::orderBy('names')->get();
        return view('admin.payments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'description' => 'nullable|string|max:190'
        ], [
            'patient_id.required' => 'El paciente es obligatorio.',
            'patient_id.exists' => 'El paciente seleccionado no existe.',
            'doctor_id.required' => 'El doctor es obligatorio.',
            'doctor_id.exists' => 'El doctor seleccionado no existe.',
            'amount.required' => 'El monto es obligatorio.',
            'amount.numeric' => 'El monto debe ser un número.',
            'amount.min' => 'El monto debe ser mayor a 0.',
            'payment_date.required' => 'La fecha de pago es obligatoria.',
            'payment_date.date' => 'La fecha debe ser válida.',
            'description.max' => 'La descripción no debe exceder los 190 caracteres.'
        ]);

        try {
            Payment::create($validated);
            return redirect()->route('admin.payments.index')
                ->with('message', 'Pago registrado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            return redirect()->route('admin.payments.create')
                ->with('message', 'Hubo un problema al registrar el pago.')
                ->with('icons', 'error');
        }
    }

    public function show($id)
    {
        $payment = Payment::with(['patient', 'doctor'])->findOrFail($id);
        return view('admin.payments.show', compact('payment'));
    }

    public function edit($id)
    {
        $payment = Payment::with(['patient', 'doctor'])->findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::all();
        return view('admin.payments.edit', compact('payment', 'patients', 'doctors'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
            'description' => 'nullable|string|max:190'
        ], [
            'patient_id.required' => 'El paciente es obligatorio.',
            'patient_id.exists' => 'El paciente seleccionado no existe.',
            'doctor_id.required' => 'El doctor es obligatorio.',
            'doctor_id.exists' => 'El doctor seleccionado no existe.',
            'amount.required' => 'El monto es obligatorio.',
            'amount.numeric' => 'El monto debe ser un número.',
            'amount.min' => 'El monto debe ser mayor a 0.',
            'payment_date.required' => 'La fecha de pago es obligatoria.',
            'payment_date.date' => 'La fecha debe ser válida.',
            'description.max' => 'La descripción no debe exceder los 190 caracteres.'
        ]);

        try {
            $payment->update($validated);
            return redirect()->route('admin.payments.index')
                ->with('message', 'Pago actualizado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            return redirect()->route('admin.payments.edit', $payment->id)
                ->with('message', 'Hubo un problema al actualizar el pago.')
                ->with('icons', 'error');
        }
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('admin.payments.index')
            ->with('message', 'Pago eliminado correctamente.')
            ->with('icons', 'success');
    }

    public function reports()
    {
        $doctors = Doctor::orderBy('names')->get();
        
        $query = Payment::with(['patient', 'doctor'])->orderBy('payment_date', 'desc');

        // Aplicar filtros si existen
        if (request('start_date')) {
            $query->whereDate('payment_date', '>=', request('start_date'));
        }
        if (request('end_date')) {
            $query->whereDate('payment_date', '<=', request('end_date'));
        }
        if (request('doctor_id')) {
            $query->where('doctor_id', request('doctor_id'));
        }

        // Agregar filtro de búsqueda de paciente
        if (request('patient_search')) {
            $searchTerm = request('patient_search');
            $query->whereHas('patient', function($q) use ($searchTerm) {
                $q->where(function($query) use ($searchTerm) {
                    $query->where('names', 'LIKE', "%{$searchTerm}%")
                          ->orWhere('last_names', 'LIKE', "%{$searchTerm}%")
                          ->orWhere('ci', 'LIKE', "%{$searchTerm}%");
                });
            });
        }

        $payments = $query->latest('payment_date')->get();

        // Calcular estadísticas
        $statistics = [
            'total_payments' => $payments->count(),
            'total_amount' => $payments->sum('amount')
        ];

        return view('admin.payments.reports', compact('payments', 'doctors', 'statistics'));
    }

    public function pdfIndividual($id)
    {
        $payments = Payment::with(['patient', 'doctor'])->where('id', $id)->get();
        // dd($payments);
        $configuration = Configuration::latest()->first();
        
        $payment = $payments->first();
        $data = "Codigo de seguridad del comprobante de pago del paciente: ".$payment->patient->names." ".$payment->patient->last_names." en la fecha ".$payment->payment_date." por el monto de ".$payment->amount;

        // Generar el QR Code
        $qrCode = new QrCode($data);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $qrCodeBase64    = base64_encode($result->getString());

        $pdf = \PDF::loadView('admin.payments.pdf', compact('payments', 'configuration', 'data', 'qrCodeBase64'));
        
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        
        $canvas->page_text(20, 800, "Impreso por: " . Auth::user()->name, null, 10, array(0,0,0));
        $canvas->page_text(450, 800, "Fecha: " . Carbon::now()->format('d/m/Y')." ". Carbon::now()->format('H:i:s'), null, 10, array(0,0,0));

        return $pdf->stream('pago-'.$id.'.pdf');
    }

    public function pdfReport()
    {
        $query = Payment::with(['patient', 'doctor']);

        // Aplicar filtros
        if (request('start_date')) {
            $query->whereDate('payment_date', '>=', request('start_date'));
        }
        if (request('end_date')) {
            $query->whereDate('payment_date', '<=', request('end_date'));
        }
        if (request('doctor_id')) {
            $query->where('doctor_id', request('doctor_id'));
        }

        // Agregar filtro de búsqueda de paciente
        if (request('patient_search')) {
            $searchTerm = request('patient_search');
            $query->whereHas('patient', function($q) use ($searchTerm) {
                $q->where(function($query) use ($searchTerm) {
                    $query->where('names', 'LIKE', "%{$searchTerm}%")
                          ->orWhere('last_names', 'LIKE', "%{$searchTerm}%")
                          ->orWhere('ci', 'LIKE', "%{$searchTerm}%");
                });
            });
        }

        $payments = $query->latest('payment_date')->get();
        $configuration = Configuration::latest()->first();

        // Crear el texto para el QR con todos los pagos
        $data = "Reporte de pagos generado el " . Carbon::now()->format('d/m/Y H:i:s') . "\n\n";
        
        $data .= "-------- Datos del reporte ------\n";
        $data .= "Total pagos: " . $payments->count() . "\n";
        $data .= "Monto total: $" . number_format($payments->sum('amount'), 2) . "\n";
        $data .= "Doctores involucrados:\n";
        foreach($payments->pluck('doctor')->unique() as $doctor) {
            $data .= "- Dr(a). " . $doctor->names . " " . $doctor->last_names . "\n";
        }
        $data .= "Generado por: " . Auth::user()->name . "\n";
        $data .= "Clinica: " . $configuration->name . "\n";
        $data .= "----------------------------------\n";

        // Generar el QR Code
        $qrCode = new QrCode($data);
        $writer = new PngWriter();
        $result = $writer->write($qrCode);
        $qrCodeBase64 = base64_encode($result->getString());

        $pdf = \PDF::loadView('admin.payments.pdf', compact('payments', 'configuration', 'qrCodeBase64'));
        
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        
        $canvas->page_text(20, 800, "Impreso por: " . Auth::user()->name, null, 10, array(0,0,0));
        $canvas->page_text(450, 800, "Fecha: " . Carbon::now()->format('d/m/Y')." ". Carbon::now()->format('H:i:s'), null, 10, array(0,0,0));

        return $pdf->stream('reporte-pagos.pdf');
    }
}
