<?php
$i = 0;
do {
    echo("<label class='input-group-text'>Ładunek nr " . $i + 1 . "</label>");
    echo('<div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text">Nazwa ładunku</label>
                 </div>
                <input type="text" class="form-control" id="cargoName" name="cargoName' . $i . '" required
                    placeholder="Wpisz nazwę">
               </div>');

    echo('<div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Ciężar ładunku w kg</label>
                    </div>
                    <input type="number" step="0.01" class="form-control" id="cargoWeight" name="cargoWeight' . $i . '" max="38000"
                        required placeholder="Wpisz ciężar">
              </div>');

    echo('<div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Typ ładunku</label>
                     </div>
                    <select class="form-select" id="inputGroupSelectCargoType" name = "cargoType' . $i . '">
                        <option value="ladunek zwykly">Ładunek zwykły</option>
                        <option value="ladunek niebezpieczny">Ładunek niebezbieczny</option>
                    </select>
              </div>');

    $i++;
} while ($i < $cargoNumber);
