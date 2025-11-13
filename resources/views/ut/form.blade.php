<div class="col-md-6">
  <label class="form-label">Név</label>
  <input name="nev" class="form-control @error('nev') is-invalid @enderror" value="{{ old('nev', $ut->nev ?? '') }}">
  @error('nev')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
<div class="col-md-3">
  <label class="form-label">Hossz (km)</label>
  <input type="number" step="0.01" min="0" name="hossz" class="form-control" value="{{ old('hossz', $ut->hossz ?? '') }}">
</div>
<div class="col-md-3">
  <label class="form-label">Állomás</label>
  <input type="number" min="0" name="allomas" class="form-control" value="{{ old('allomas', $ut->allomas ?? '') }}">
</div>
<div class="col-md-3">
  <label class="form-label">Idő (óra)</label>
  <input type="number" step="0.1" min="0" name="ido" class="form-control" value="{{ old('ido', $ut->ido ?? '') }}">
</div>
<div class="col-md-3">
  <label class="form-label">Vezetett?</label>
  <select name="vezetes" class="form-select">
    <option value="0" {{ old('vezetes', $ut->vezetes ?? 0)==0 ? 'selected':'' }}>Nem</option>
    <option value="1" {{ old('vezetes', $ut->vezetes ?? 0)==1 ? 'selected':'' }}>Igen</option>
  </select>
</div>
<div class="col-md-6">
  <label class="form-label">Település</label>
  <select name="telepulesid" class="form-select">
    @foreach($telepules as $t)
      <option value="{{ $t->id }}" {{ (string)old('telepulesid', $ut->telepulesid ?? '') === (string)$t->id ? 'selected':'' }}>
        {{ $t->nev }} @if($t->np) ({{ $t->np->nev }}) @endif
      </option>
    @endforeach
  </select>
</div>
