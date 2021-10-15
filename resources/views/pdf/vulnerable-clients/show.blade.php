@extends('layouts.pdf')

@section('pdfTitle')
  <div class="header-title">Vulnerable Client</div>
@endsection

@section('content')
  <p>&nbsp;</p>
  <table class="table-striped w-full">
    <tr>
      <td class="p-2">Name:</td>
      <td class="py-2 pr-2" colspan="4">{{ $client->name }}</td>
    </tr>
    <tr>
      <td class="p-2">Insurer:</td>
      <td class="py-2">{{ $client->insurer }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Policy Number:</td>
      <td class="py-2 pr-2">{{ $client->policy_number }}</td>
    </tr>
    <tr>
      <td class="p-2">Date Issued:</td>
      <td class="py-2">{{ $client->issued_at->format('d/m/Y') }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Nature:</td>
      <td class="py-2 pr-2">{{ $client->nature }}</td>
    </tr>
  </table>

  <p>&nbsp;</p>
  <h1 class="section-title">&emsp;Notes</h1>

  <div class="table-striped">
    @if ($client->notes()->count())
      <div>
        <div class="float-left p-2 font-bold" style="width:150px; min-width:150px; max-width:150px;">Date Added</div>
        <div class="float-left p-2 font-bold" style="width:125px; min-width:125px; max-width:125px;">Noted By</div>
        <div class="float-left p-2 font-bold" style="width:324px; min-width:324px; max-width:324px;">Notes</div>
      </div>
      @foreach ($client->notes()->latest('created_at')->get()
      as $key => $note)
        <div class="{{ $key % 2 == 0 ? 'bg-gray' : null }}">
          <div class="float-left p-2 font-bold" style="width:150px; min-width:150px; max-width:150px;">{{ $note->created_at->format('d/m/y h:i A') }}</div>
          <div class="float-left p-2 font-bold" style="width:125px; min-width:125px; max-width:125px;">{{ $note->creator->name }}</div>
          <div class="float-left p-2 font-bold" style="width:324px; min-width:324px; max-width:324px;">{{ $note->notes }}</div>
        </div>
      @endforeach
    @else
      <div class="p-2">No available notes.</div>
    @endif
  </div>
@endsection
