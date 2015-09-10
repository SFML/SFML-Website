<?php

    function makeProgressbar($max, $value)
    {
        $html = <<<HTML
    <div class="progressbar">
        <div class="bar" style="width: %d%%"></div>
        <span class="caption">
            <strong>%.2f €</strong> out of %.2f €
        </span>
    </div>
HTML;
        $percentage = min(100.0, max(0.0, $value / $max * 100.0));
        $output = sprintf($html,
                          $percentage,
                          $value, $max);
        return $output;
    }

?>
