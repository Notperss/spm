<table class="table table-bordered ">
  <tr>
    <th>Log Name</th>
    <td>
      {{ isset($item->log_name) ? $item->log_name : 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>User (Causer)</th>
    <td>
      {{ isset($item->causer->name) ? $item->causer->name : 'N/A' }}
      {{ optional($item->causer)->getRoleNames() ?? 'N/A' }}
    </td>
  </tr>
  <tr>
    <th>Description</th>
    <td>{{ isset($item->description) ? $item->description : 'N/A' }}</td>
  </tr>

  <tr>
    <th>Subject</th>
    <td>
      {{ isset($item->subject) ? $item->subject->name : 'N/A' }}
    </td>
  </tr>

  {{-- <tr>
    <th>Properties</th>
    <td>{{ isset($item->properties) ? $item->properties : 'N/A' }}</td>
  </tr> --}}
  @if (isset($item->attribute_changes['attributes']) || isset($item->attribute_changes['old']))
    <tr>
      <th>New</th>
      <td class="text-start">
        @if (isset($item->attribute_changes['attributes']))
          <ul>
            @foreach ($item->attribute_changes['attributes'] as $key => $value)
              <li><strong>{{ $key }}: </strong> {{ $value }}</li>
            @endforeach
          </ul>
        @else
          N/A
        @endif
      </td>
    </tr>
    <tr>
      <th>Old</th>
      <td class="text-start">
        @if (isset($item->attribute_changes['old']))
          <ul>
            @foreach ($item->attribute_changes['old'] as $key => $value)
              <li><strong>{{ $key }}: </strong> {{ $value }}</li>
            @endforeach
          </ul>
        @else
          N/A
        @endif
      </td>
    </tr>
  @endif

  @if (isset($item->properties['ip']))
    <tr>
      <th>IP Address</th>
      <td>
        {{ $item->properties['ip'] }}
      </td>
    </tr>
  @endif
  @if (isset($item->properties['agent']))
    <tr>
      <th>User Agent</th>
      <td>
        {{ $item->properties['agent'] }}
      </td>
    </tr>
  @endif


  <tr>
    <th>Created At</th>
    <td>
      {{ isset($item->created_at) ? Carbon\Carbon::parse($item->created_at)->translatedFormat(' H:i:s - l, d F Y') : 'N/A' }}
    </td>
  </tr>
</table>
