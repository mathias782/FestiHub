<h1>Nieuw contactformulier</h1>
<p><strong>Naam:</strong> {{ $m->name }}</p>
<p><strong>Email:</strong> {{ $m->email }}</p>
@if($m->subject)<p><strong>Onderwerp:</strong> {{ $m->subject }}</p>@endif
<hr>
<pre style="white-space: pre-wrap">{{ $m->message }}</pre>
