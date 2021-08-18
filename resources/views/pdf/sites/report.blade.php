@extends('layouts.pdf')

@section('content')
  <p>&nbsp;</p>
  <table class="table-striped w-full">
    <tr>
      <td class="p-2">
        @if ($filter['launch_from'] && $filter['launch_to'])
          Launched from <span
            class="font-bold">{{ \Illuminate\Support\Carbon::parse($filter['launch_from'])->format('d/m/Y') }}</span>
          to <span
            class="font-bold">{{ \Illuminate\Support\Carbon::parse($filter['launch_to'])->format('d/m/Y') }}</span>
        @else
          Date Launched: N/A
        @endif
      </td>
    </tr>
    <tr>
      <td class="p-2">
        @if ($filter['update_from'] && $filter['update_to'])
          Last Updated from <span
            class="font-bold">{{ \Illuminate\Support\Carbon::parse($filter['update_from'])->format('d/m/Y') }}</span>
          to <span
            class="font-bold">{{ \Illuminate\Support\Carbon::parse($filter['update_to'])->format('d/m/Y') }}</span>
        @else
          Date Last Updated: N/A
        @endif
      </td>
    </tr>
  </table>

  <p>&nbsp;</p>

  @if ($sites->count())
    <table class="table-striped w-full">
      <tr>
        <th class="p-2 text-left">Name</th>
        <th class="p-2 text-left">Link</th>
        <th class="p-2 text-left">Date Launched</th>
        <th class="p-2 text-left">Date Last Updated</th>
        <th class="p-2 text-left">Description</th>
      </tr>
      @foreach ($sites as $site)
        <tr>
          <td class="p-2">{{ $site->name }}</td>
          <td class="p-2">{{ $site->url }}</td>
          <td class="p-2">{{ $site->launch_date->format('d/m/Y') }}</td>
          <td class="p-2">{{ $site->update_date ? $site->update_date->format('d/m/Y') : '' }}</td>
          <td class="p-2">{{ $site->description }}</td>
        </tr>
      @endforeach
    </table>
  @else
    <p>No available software.</p>
  @endif
@endsection
