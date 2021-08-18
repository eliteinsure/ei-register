@extends('layouts.pdf')

@section('content')
  <p>&nbsp;</p>
  <table class="table-striped w-full">
    <tr>
      <td class="p-2">
        Received from <span
          class="font-bold">{{ \Illuminate\Support\Carbon::parse($filter['received_from'])->format('d/m/Y') }}</span>
        to <span
          class="font-bold">{{ \Illuminate\Support\Carbon::parse($filter['received_to'])->format('d/m/Y') }}</span>
      </td>
    </tr>
    <tr>
      <td class="p-2">Advisers:
        <span class="font-bold">{{ isset($advisers) ? $advisers->implode(', ') : 'All' }}</span>
      </td>
    </tr>
  </table>

  <p>&nbsp;</p>

  @if ($complaints->count())
    <table class="table-striped w-full">
      <tr>
        <th class="p-2 text-left">Complaint Number</th>
        <th class="p-2 text-left">Complainant Name</th>
        <th class="p-2 text-left">Date Received</th>
        <th class="p-2 text-left">Nature of Complaint</th>
        <th class="p-2 text-left">Status</th>
      </tr>
      @foreach ($complaints as $complaint)
        <tr>
          <td class="p-2">{{ $complaint->number }}</td>
          <td class="p-2">{{ $complaint->complainant }}</td>
          <td class="p-2">{{ $complaint->received_at->format('d/m/Y') }}</td>
          <td class="p-2">{{ $complaint->nature }}</td>
          <td class="p-2">{{ $complaint->status }}</td>
        </tr>
      @endforeach
    </table>
  @else
    <p>No available complaints.</p>
  @endif
@endsection
