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
      <td class="p-2">Complainant Name:</td>
      <td class="py-2 pr-2 w-quart">{{ $complaint->complainant }}</td>
    </tr>
    <tr>
      <td class="p-2">Label:</td>
      <td class="py-2">{{ $complaint->label }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Policy Number:</td>
      <td class="py-2 pr-2">{{ $complaint->policy_number ?? 'N/A' }}</td>
    </tr>
    <tr>
      <td class="p-2">Insurer:</td>
      <td class="py-2">{{ $complaint->insurer ?? 'N/A' }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Date Received:</td>
      <td class="py-2 pr-2">{{ $complaint->received_at->format('d/m/Y') }}</td>
    </tr>
    <tr>
      <td class="p-2">Date Registered:</td>
      <td class="py-2">{{ $complaint->created_at->format('d/m/Y') }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Date Acknowledged:</td>
      <td class="py-2 pr-2">{{ $complaint->acknowledged_at->format('d/m/Y') }}</td>
    </tr>
    <tr>
      <td class="p-2">Days Counter:</td>
      <td class="py-2">{{ number_format($complaint->day_counter) }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Nature of Complaint:</td>
      <td class="py-2 pr-2">{{ $complaint->nature }}</td>
    </tr>
  </table>

  <p>&nbsp;</p>

  <h1 class="section-title">&emsp;Tier 1</h1>

  <table class="table-striped w-full">
    <tr>
      <td class="p-2">Adviser:</td>
      <td class="py-2">{{ $complaint->adviser->name }} ({{ $complaint->adviser->type }})</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Date Handed Over:</td>
      <td class="py-2 pr-2">
        {{ \Illuminate\Support\Carbon::parse($complaint->tier['1']['handed_over_at'])->format('d/m/Y') }}
      </td>
    </tr>
    <tr>
      <td class="p-2">Status:</td>
      <td class="py-2">{{ $complaint->tier['1']['status'] }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Date Stated:</td>
      <td class="py-2 pr-2">
        {{ $complaint->tier['1']['stated_at'] ?? '' ? \Illuminate\Support\Carbon::parse($complaint->tier['1']['stated_at'])->format('d/m/Y') : '' }}
      </td>
    </tr>
    <tr>
      <td class="p-2">Notes:</td>
      <td class="py-2 pr-2 w-third" colspan="4">{{ $complaint->tier['1']['notes'] ?? '' }}</td>
    </tr>
  </table>

  @if (isset($complaint->tier['2']))
    <p>&nbsp;</p>

    <h1 class="section-title">&emsp;Tier 2</h1>

    <table class="table-striped w-full">
      <tr>
        <td class="p-2">Staff:</td>
        <td class="py-2">{{ $complaint->tier['2']['staff_position'] }}</td>
        <td class="w-4">&nbsp;</td>
        <td class="p-2">Staff Name:</td>
        <td class="py-2 pr-2">{{ $complaint->staff->name }} ({{ $complaint->staff->type }})
        </td>
      </tr>
      <tr>
        <td class="p-2">Date Handed Over:</td>
        <td class="py-2">
          {{ \Illuminate\Support\Carbon::parse($complaint->tier['2']['handed_over_at'])->format('d/m/Y') }}
        </td>
        <td class="w-4">&nbsp;</td>
        <td class="p-2">Status:</td>
        <td class="py-2 pr-2">{{ $complaint->tier['2']['status'] }}</td>
      </tr>
      <tr>
        <td class="p-2">Notes:</td>
        <td class="py-2 pr-2 w-third" colspan="4">{{ $complaint->tier['2']['notes'] ?? '' }}</td>
      </tr>
    </table>
  @endif
@endsection
