<?php
function genericSection($data)
{
    if ($data['alignment'] == 'left') {
        $subheads = $data['subheads'];
        echo "<div class='container border-bottom' style='padding: 3em 1em;'>
        <div class='row justify-content-around'>
            <div class='col-4'>
                <h2 class='fw-bold' style='color:#2d314e'>" . $data['heading'] . "</h2>
                <p class='text-secondary my-4'>" . $data['description'] . "</p>
            </div>
            <div class='col-4'>";

        foreach ($subheads as $obj) {
            echo "  <div class='row mb-4'>
                    <h6 class='fw-bold' style='color:#2d314e'>" . $obj["heading"] . "</h6>
                    <p class='text-secondary my-2'>" . $obj["description"] . "
                    </p>
                </div>";
        }
        echo "</div></div></div>";
    } else {
        $subheads = $data['subheads'];
        echo "<div class='container border-bottom' style='padding: 3em 1em;'>
        <div class='row justify-content-around'>
            <div class='col-4'>";
        foreach ($subheads as $obj) {
            echo "  <div class='row mb-4'>
                    <h6 class='fw-bold' style='color:#2d314e'>" . $obj["heading"] . "</h6>
                    <p class='text-secondary my-2'>" . $obj["description"] . "
                    </p>
                    </div>";
        }
        echo "</div>";
        echo "<div class='col-4'>
                <h2 class='fw-bold' style='color:#2d314e'>" . $data['heading'] . "</h2>
                <p class='text-secondary my-4'>" . $data['description'] . "</p>
            </div>
            </div>";
        echo "</div></div>";
    }
}
?>