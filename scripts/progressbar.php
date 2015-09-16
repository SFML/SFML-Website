<?php

    /**
     * Make a progress bar.
     *
     * Format of $goals parameter:
     *
     * array(array("title" => "Goal", "value" => 500.0),
     *       array("title" => "Stretch 1", "value" => 600.0),
     *       array("title" => "Stretch 2", "value" => 800.0))
     */
    function makeProgressbar($value, $goals)
    {
        $max = 0.0;
        $nextStep = 0.0;

        foreach($goals as $goal)
        {
            $max = max($max, $goal["value"]);

            if($goal["value"] >= $value)
                $nextStep = $nextStep === 0.0 ?
                            $goal["value"] :
                            min($nextStep, $goal["value"]);
        }

        if($nextStep === 0.0)
            $nextStep = $max;

        $goalsHtml = "";

        foreach($goals as $goal)
        {
            $pieceHtml =
                "<span class=\"goal-text\" style=\"right: %d%%\">%s (%.2f €)</span>" .
                "<span class=\"goal-line\" style=\"right: %d%%\"></span>";
            $percentage = 100.0 - (100.0 * $goal["value"] / $max);
            $goalsHtml .= sprintf($pieceHtml,
                                  $percentage,
                                  $goal["title"], $goal["value"],
                                  $percentage);
        }

        $html = <<<HTML
<div class="progressbar">
    <div class="bar" style="width: %d%%"></div>
    <span class="caption">
        <strong>%.2f €</strong> out of %.2f €
    </span>
    %s
</div>
HTML;

        $totalPercentage = min(100.0, max(0.0, $value * 100.0 / $max));
        $output = sprintf($html,
                          $totalPercentage,
                          $value, $nextStep,
                          $goalsHtml);
        return $output;
    }

?>
