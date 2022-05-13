<?php
$i = 0;
do {
    echo("<label class='input-group-text'>Ładunek nr " . $i + 1 . "</label>");
    echo('<div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">Nazwa ładunku</label>
                 </div>
                <input type="text" class="form-control" id="nazwa_ladunku" name="nazwa_ladunku' . $i . '" required
                    placeholder="Wpisz nazwę">
               </div>');

    echo('<div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Ciężar ładunku w kg</label>
                    </div>
                    <input type="number" step="0.01" class="form-control" id="ciezar_ladunku" name="ciezar_ladunku' . $i . '" max="38000"
                        required placeholder="Wpisz ciężar">
              </div>');

    echo('<div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Typ ładunku</label>
                     </div>
                    <select class="custom-select" id="inputGroupSelectTypLadunku" name = "typ_ladunku' . $i . '">
                        <option value="ladunek zwykly">Ładunek zwykły</option>
                        <option value="ladunek niebezpieczny">Ładunek niebezbieczny</option>
                    </select>
              </div>');

    $i++;
} while ($i < $packageNumber);
