<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title }}</title>

  <link rel="stylesheet" href="{{ mix('css/pdf.css') }}" />
</head>

<body>
  <htmlpageheader name="page-header-first">
    <table class="header">
      <tr>
        <td class="header-left-box">
          &nbsp;
        </td>
        <td class="header-image"><img
            src="{{ asset('images/logo-only.png') }}"
            height="0.76in" /></td>
        <td class="header-title">{{ $title }}</td>
        <td class="header-right-box">
          &nbsp;
        </td>
      </tr>
    </table>
  </htmlpageheader>

  <htmlpageheader name="page-header">
    <table class="header">
      <tr>
        <td class="header-left-box">
          &nbsp;
        </td>
        <td class="header-image"><img
            src="{{ asset('images/logo-only.png') }}"
            height="0.76in" /></td>
        <td class="header-title">&nbsp;</td>
        <td class="header-right-box">
          &nbsp;
        </td>
      </tr>
    </table>
  </htmlpageheader>

  <htmlpagefooter name="page-footer">
    <table class="table-footer">
      <tr>
        <td class="footer-logo">
          <img src="{{ asset('images/horizontal-logo.png') }}"
            width="2.12in" />
        </td>
        <td class="footer-page">
          <a
            href="{{ config('services.company.url') }}"
            class="footer-link"
            target="_blank">{{ config('services.company.web') }}</a>&nbsp;|&nbsp;Page
          {PAGENO}
        </td>
      </tr>
    </table>
  </htmlpagefooter>

  <div class="margin">
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
  </div>
</body>

</html>
