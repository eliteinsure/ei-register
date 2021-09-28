@extends('layouts.pdf')

@section('pdfTitle')
  <div class="header-title">Complaint</div>
@endsection

@section('content')
  <p>&nbsp;</p>
  <table class="table-striped w-full">
    <tr>
      <td class="p-2">Complaint Number:</td>
      <td class="py-2 w-quart">{{ $complaint->number }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">&nbsp;</td>
      <td class="py-2 pr-2 w-quart">&nbsp;</td>
    </tr>
    <tr>
      <td class="p-2">Complainant Name:</td>
      <td class="py-2">{{ $complaint->complainant }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Label:</td>
      <td class="py-2 pr-2">{{ $complaint->label }}</td>
    </tr>
    <tr>
      <td class="p-2">Complainee Name:</td>
      <td class="py-2">{{ $complaint->complainee }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Label:</td>
      <td class="py-2 pr-2">{{ $complaint->complainee_label }}</td>
    </tr>
    <tr>
      <td class="p-2">Policy Number:</td>
      <td class="py-2">{{ $complaint->policy_number ?? 'N/A' }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Insurer:</td>
      <td class="py-2 pr-2">{{ $complaint->insurer ?? 'N/A' }}</td>
    </tr>
    <tr>
      <td class="p-2">Date Received:</td>
      <td class="py-2">{{ $complaint->received_at->format('d/m/Y') }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Date Registered:</td>
      <td class="py-2 pr-2">{{ $complaint->created_at->format('d/m/Y') }}</td>
    </tr>
    <tr>
      <td class="p-2">Date Acknowledged:</td>
      <td class="py-2">{{ $complaint->acknowledged_at->format('d/m/Y') }}</td>
      {{-- <td class="p-2">Days Counter:</td>
      <td class="py-2">{{ number_format($complaint->day_counter) }}</td> --}}
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Nature of Complaint:</td>
      <td class="py-2 pr-2">{{ $complaint->nature }}</td>
    </tr>
  </table>

  <p>&nbsp;</p>

  <h1 class="section-title">&emsp;Tier</h1>

  <table class="table-striped w-full">
    <tr>
      <td class="p-2">Tier:</td>
      <td class="py-2 w-quart">{{ $complaint->tier['tier'] }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Handled By:</td>
      <td class="py-2 pr-2 w-quart">{{ $complaint->tier['handler'] }}</td>
    </tr>
    <tr>
      <td class="p-2">Adviser:</td>
      <td class="py-2">{{ $complaint->tier['handler'] == 'Adviser' ? $complaint->adviser->name . '(' . $complaint->adviser->type . ')' : 'N/A' }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Status:</td>
      <td class="py-2 pr-2">{{ $complaint->tier['status'] }}</td>
    </tr>
    <tr>
      <td class="p-2">Date Completed:</td>
      <td class="py-2">
        {{ $complaint->tier['completed_at'] ?? '' ? \Illuminate\Support\Carbon::parse($complaint->tier['completed_at'])->format('d/m/Y') : '' }}
      </td>
      <td colspan="3">&nbsp;</td>
    </tr>
    <tr>
      <td class="p-2">Notes:</td>
      <td class="py-2 pr-2" colspan="4">&nbsp;</td>
    </tr>
    @foreach ($complaint->notes()->latest('created_at')->get()
      as $note)
      <tr>
        <td class="p-2 align-top">{{ $note->created_at->format('d/m/Y h:i A') }}</td>
        <td class="p-2 align-top">{{ $note->creator->name }}</td>
        <td class="p-2 align-top" colspan="3">{{ $note->notes }}</td>
      </tr>
    @endforeach
  </table>
@endsection
