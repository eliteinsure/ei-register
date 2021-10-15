@extends('layouts.pdf')

@section('pdfTitle')
  <div class="header-title lg">Vulnerable Clients Register</div>
  <div class="header-title-sm">Report</div>
@endsection

@section('content')
  <p>&nbsp;</p>
  <table class="table-striped w-full">
    <tr>
      <td class="p-2">
        Issued from <span class="font-bold">{{ \Illuminate\Support\Carbon::parse($filter['issued_from'])->format('d/m/Y') }}</span> to <span
          class="font-bold">{{ \Illuminate\Support\Carbon::parse($filter['issued_to'])->format('d/m/Y') }}</span>
      </td>
    </tr>
  </table>

  <p>&nbsp;</p>

  @if ($clients->count())
    <table class="table-striped w-full">
      <tr>
        <th class="p-2 text-left">Name</th>
        <th class="p-2 text-left">Insurer</th>
        <th class="p-2 text-left">Policy Number</th>
        <th class="p-2 text-left">Date Issued</th>
        <th class="p-2 text-left">Nature</th>
      </tr>
      @foreach ($clients as $client)
        <tr>
          <td class="p-2">{{ $client->name }}</td>
          <td class="p-2">{{ $client->insurer }}</td>
          <td class="p-2">{{ $client->policy_number }}</td>
          <td class="p-2">{{ $client->issued_at->format('d/m/Y') }}</td>
          <td class="p-2">{{ $client->nature }}</td>
        </tr>
      @endforeach
    </table>
  @else
    <p>No available vulnerable clients.</p>
  @endif
@endsection
