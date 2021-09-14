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
        <td class="header-title">@yield('pdfTitle', $title)</td>
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
        <td colspan="2" class="text-sm text-justify" style="padding-left: 0.5in; padding-right: 0.5in;">
          Disclaimer: Eliteinsure has used reasonable endeavours to ensure the accuracy and completeness of
          the information provided but makes no warranties as to the accuracy or completeness of such
          information. The information should not be taken as advice. Eliteinsure accepts no responsibility
          for the results of any omissions or actions taken on basis of this information. This report includes
          commercially sensitive information. Accordingly, it may be used for the purpose provided; may not be
          disclosed to any third party; and will be subject to any obligation of confidence owed by the
          recipient under contract or otherwise.
        </td>
      </tr>
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
    @yield('content')
  </div>
</body>

</html>
