<label class="input-group-text">Informacje ogólne ładunku</label>
<div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text">Transport z</label>
    </div>
    <input type="text" class="form-control" id="transport_z" name="transport_z" required
           placeholder="Wpisz miasto">
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text">Transport do</label>
    </div>
    <input type="text" class="form-control" id="transport_do" name="transport_do" required
           placeholder="Wpisz miasto">
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text">Typ samolotu</label>
    </div>
    <select class="custom-select" id="inputGroupSelectSamolot" name="inputGroupSelectSamolot">
        <option selected value="35000">Airbus A380 (Maksymalna waga pojedynczego ładudunku 35 ton)</option>
        <option value="38000">Boeing 747 (Maksymalna waga pojedynczego ładudunku 38 ton)</option>
    </select>
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text">Dokumenty przewozowe</label>
    </div>
    <input type="file" class="form-control" id="dokumenty" name="dokumenty[]"
           accept=".pdf, .jpg, .png, .doc, .docx" multiple>
</div>

<div class="input-group mb-3">
    <div class="input-group-prepend">
        <label class="input-group-text">Data transportu</label>
    </div>
    <input type="date" id="data_transportu" name="data_transportu"
           value="<?php echo $today ?>"
           min="<?php echo $today ?>">
</div>