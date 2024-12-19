<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Historial;
use Illuminate\Http\Request;
use App\Models\Configuration;
use Illuminate\Support\Facades\Auth;

class HistorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historiales = Historial::with(['patient', 'doctor'])->get();
        return view('admin.historial.index', compact('historiales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $patients = Patient::orderBy('names', 'asc')->get();
        $doctors = Doctor::orderBy('names', 'asc')->get();
        return view('admin.historial.create', compact('patients', 'doctors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'detail' => 'required|string',
            'visit_date' => 'required|date',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ], [
            'detail.required' => 'El detalle es obligatorio.',
            'visit_date.required' => 'La fecha de visita es obligatoria.',
            'visit_date.date' => 'La fecha de visita debe ser una fecha válida.',
            'patient_id.required' => 'El paciente es obligatorio.',
            'patient_id.exists' => 'El paciente seleccionado no existe.',
            'doctor_id.required' => 'El doctor es obligatorio.',
            'doctor_id.exists' => 'El doctor seleccionado no existe.',
        ]);

        try {
            // Crear el historial con los datos validados
            Historial::create($validated);

            // Redirigir con mensaje de éxito
            return redirect()->route('admin.historial.index')
                ->with('message', 'Historial creado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Si ocurre un error, redirigir con mensaje de error
            return redirect()->route('admin.historial.create')
                ->with('message', 'Hubo un problema al crear el historial.')
                ->with('icons', 'error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $historial = Historial::with(['patient', 'doctor'])->findOrFail($id);
        return view('admin.historial.show', compact('historial'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $historial = Historial::with(['patient', 'doctor'])->findOrFail($id);
        $patients = Patient::orderBy('names', 'asc')->get();
        $doctors = Doctor::orderBy('names', 'asc')->get();
        return view('admin.historial.edit', compact('historial', 'patients', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Encuentra el historial por ID o lanza una excepción si no se encuentra
        $historial = Historial::findOrFail($id);

        // Valida los datos de entrada
        $validated = $request->validate([
            'detail' => 'required|string',
            'visit_date' => 'required|date',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
        ], [
            'detail.required' => 'El detalle es obligatorio.',
            'visit_date.required' => 'La fecha de visita es obligatoria.',
            'visit_date.date' => 'La fecha de visita debe ser una fecha válida.',
            'patient_id.required' => 'El paciente es obligatorio.',
            'patient_id.exists' => 'El paciente seleccionado no existe.',
            'doctor_id.required' => 'El doctor es obligatorio.',
            'doctor_id.exists' => 'El doctor seleccionado no existe.',
        ]);

        try {
            // Actualiza el historial con los datos validados
            $historial->update($validated);

            // Redirige a la lista de historiales con un mensaje de éxito
            return redirect()->route('admin.historial.index')
                ->with('message', 'Historial actualizado correctamente.')
                ->with('icons', 'success');
        } catch (\Exception $e) {
            // Si ocurre un error, redirige con mensaje de error
            return redirect()->route('admin.historial.edit', $historial->id)
                ->with('message', 'Hubo un problema al actualizar el historial.')
                ->with('icons', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $historial = Historial::findOrFail($id);
        $historial->delete();
        return redirect()->route('admin.historial.index')
            ->with('message', 'Historial eliminado correctamente.')
            ->with('icons', 'success');
    }

    public function reports()
    {
        return view('admin.historial.reports');
    }

    public function pdf($id)
    {
        $historial = Historial::findOrFail($id);
        $configuration = Configuration::latest()->first();
        
        $pdf = \PDF::loadView('admin.historial.pdf', compact('configuration', 'historial'));
        
        // // Obtener el objeto DOMPDF
        // $pdf->output();
        // $dompdf = $pdf->getDomPDF();
        // $canvas = $dompdf->getCanvas();
        
        // // Agregar número de página y fecha en el pie de página
        // $canvas->page_text(20, 800, "Impreso por: " . Auth::user()->name, null, 10, array(0,0,0));
        // $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        // $canvas->page_text(450, 800, "Fecha: " . \Carbon\Carbon::now()->format('d/m/Y')." ". \Carbon\Carbon::now()->format('H:i:s'), null, 10, array(0,0,0));

        return $pdf->stream();
    }
}
