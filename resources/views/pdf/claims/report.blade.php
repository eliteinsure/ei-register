@extends('layouts.pdf')

@section('pdfTitle')
  <div class="header-title-lg">Claims Register</div>
  <div class="header-title-sm">Report</div>
@endsection

@section('content')
  <p>&nbsp;</p>
  <table class="table-striped w-full">
    <tr>
      <td class="p-2">
        Registered from <span
          class="font-bold">{{ \Illuminate\Support\Carbon::parse($filter['created_from'])->format('d/m/Y') }}</span>
        to <span
          class="font-bold">{{ \Illuminate\Support\Carbon::parse($filter['created_to'])->format('d/m/Y') }}</span>
      </td>
    </tr>
    <tr>
      <td class="p-2">Advisers:
        <span class="font-bold">{{ isset($advisers) ? $advisers->implode(', ') : 'All' }}</span>
      </td>
    </tr>
  </table>

  <p>&nbsp;</p>

  @if ($claims->count())
    <table class="table-striped w-full">
      <tr>
        <th class="p-2 text-left">Claim Number</th>
        <th class="p-2 text-left">Client Name</th>
        <th class="p-2 text-left">Insurer</th>
        <th class="p-2 text-left">Policy Number</th>
        <th class="p-2 text-left">Adviser</th>
        <th class="p-2 text-left">Nature</th>
        <th class="p-2 text-left">Type</th>
        <th class="p-2 text-left">Status</th>
      </tr>
      @foreach ($claims as $claim)
        <tr>
          <td class="p-2">{{ $claim->number }}</td>
          <td class="p-2">{{ $claim->client_name }}</td>
          <td class="p-2">{{ $claim->insurer }}</td>
          <td class="p-2">{{ $claim->policy_number }}</td>
          <td class="p-2">{{ $claim->adviser->adviser_name }}</td>
          <td class="p-2">{{ $claim->nature }}</td>
          <td class="p-2">{{ $claim->types }}</td>
          <td class="p-2">{{ $claim->status }}</td>
        </tr>
      @endforeach
    </table>
  @else
    <p>No available claims.</p>
  @endif
@endsection
