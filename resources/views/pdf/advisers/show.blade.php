@extends('layouts.pdf')

@section('pdfTitle')
  <div class="header-title">Adviser</div>
@endsection

@section('content')
  <p>&nbsp;</p>
  <h1 class="section-title">&emsp;Basic Information</h1>
  <table class="table-striped w-full">
    <tr>
      <td class="p-2">Name:</td>
      <td class="py-2">{{ $adviser->name }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Type:</td>
      <td class="py-2 pr-2">{{ $adviser->type }}</td>
    </tr>
    <tr>
      <td class="p-2">Email:</td>
      <td class="py-2">{{ $adviser->email }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">FSP Number:</td>
      <td class="py-2 pr-2">{{ $adviser->fsp_no }}</td>
    </tr>
    <tr>
      <td class="p-2">Contact Number:</td>
      <td class="py-2">{{ $adviser->contact_number }}</td>
      <td class="w-4">&nbsp;</td>
      <td class="p-2">Status:</td>
      <td class="py-2 pr-2 {{ $adviser->status_class }}">{{ $adviser->status }}</td>
    </tr>
  </table>

  @foreach (config('services.adviser.requirements') as $requirementKey => $requirement)
    @if ($loop->index == 3)
      <div class="page-break"></div>
    @endif
    <p>&nbsp;</p>
    <h1 class="section-title">&emsp;{{ Str::title(Str::replace('_', ' ', $requirementKey)) }}</h1>
    <table class="table-striped w-full">
      @php
        $index = 0;
      @endphp
      @foreach ($requirement as $subRequirementKey => $subRequirement)
        @php
          $index++;
        @endphp

        @if ($index == 1)
          <tr>
        @endif

        <td class="p-2">{{ $subRequirement['label'] }}:</td>
        <td class="py-2 {{ $index / 2 == 1 ? 'pr-2' : null }} {{ $adviser->requirementClass($requirementKey, $subRequirementKey, $adviser->requirements[$requirementKey][$subRequirementKey]) }}">
          {{ $adviser->requirementValue($requirementKey, $subRequirementKey, $adviser->requirements[$requirementKey][$subRequirementKey]) }}
        </td>

        @if ($index == 1)
          <td class="w-4">&nbsp;</td>
        @endif

        @if ($index == 2)
          </tr>
          @php
            $index = 0;
          @endphp
        @endif
      @endforeach
    </table>
  @endforeach

  {{-- <tr>
    <td class="p-2">:</td>
    <td class="py-2">{{  }}</td>
    <td class="w-4">&nbsp;</td>
    <td class="p-2">:</td>
    <td class="py-2 pr-2">{{  }}</td>
  </tr> --}}
@endsection
