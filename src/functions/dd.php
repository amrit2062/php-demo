<?php

if (!function_exists('dd')) {
    /**
     * Dumps variables with collapsible nested arrays and objects.
     */
    function dd(...$vars)
    {
        // A self-contained function to recursively render variables
        $recursiveVarDumper = function ($data, &$seenObjects = []) use (&$recursiveVarDumper) {
            // --- Base case: Handle scalar types and NULL ---
            if (is_null($data) || is_scalar($data)) {
                $type = gettype($data);
                $value = var_export($data, true); // var_export gives a parsable string representation
                echo "<span class=\"type-{$type}\">{$value}</span>";
                return;
            }

            // --- Recursive step: Handle arrays and objects ---
            if (is_array($data) || is_object($data)) {
                // --- Recursion Detection for Objects ---
                if (is_object($data)) {
                    $hash = spl_object_id($data);
                    if (isset($seenObjects[$hash])) {
                        echo '<span class="type-recursion">*RECURSION*</span>';
                        return;
                    }
                    $seenObjects[$hash] = true;
                }

                // --- Prepare Summary Info ---
                $isObject = is_object($data);
                $summaryText = $isObject ? 'object(' . get_class($data) . ')' : 'array';
                $items = (array) $data;
                $count = count($items);
                $summaryText .= " (size={$count})";

                if ($count === 0) {
                     echo $summaryText . " {}";
                     return;
                }

                // --- Build Collapsible Block ---
                echo '<details>';
                echo "<summary>{$summaryText}</summary>";
                echo '<div class="dd-group">';
                
                foreach ($items as $key => $value) {
                    echo '<div>';
                    echo "<span class=\"key\">" . htmlspecialchars($key, ENT_QUOTES) . "</span> <span class=\"operator\">=></span> ";
                    // --- Recursive Call ---
                    $recursiveVarDumper($value, $seenObjects);
                    echo '</div>';
                }
                
                echo '</div>';
                echo '</details>';

                // Clean up seen objects for the current branch
                if (is_object($data)) {
                    unset($seenObjects[$hash]);
                }
            }
        };

        // --- CSS for styling the output ---
        echo '<style>
            .dd-main-container { background-color: #18171B; color: #F1F1F1; padding: 10px; font-family: Menlo, Monaco, Consolas, "Courier New", monospace; font-size: 14px; line-height: 1.6; }
            .dd-main-container details { margin-left: 20px; border-left: 1px dotted #555; padding-left: 15px; }
            .dd-main-container summary { cursor: pointer; color: #ff8400; font-weight: bold; outline: none; }
            .dd-main-container summary:hover { color: #ffa500; }
            .dd-main-container .dd-group { padding-top: 5px; }
            .dd-main-container .key { color: #95e783; }
            .dd-main-container .operator { color: #f1f1f1; }
            .dd-main-container .type-string { color: #e4b781; }
            .dd-main-container .type-integer, .type-double { color: #84a2f6; }
            .dd-main-container .type-boolean { color: #d679f8; font-weight: bold; }
            .dd-main-container .type-NULL { color: #888; font-weight: bold; }
            .dd-main-container .type-recursion { color: #f87979; font-style: italic; }
        </style>';
        
        // --- Render each variable passed to dd() ---
        echo '<div class="dd-main-container">';
        foreach ($vars as $var) {
            $seenObjects = []; // Reset recursion detection for each top-level variable
            $recursiveVarDumper($var, $seenObjects);
            echo '<hr style="border-color: #444; margin: 15px 0;">';
        }
        echo '</div>';

        die();
    }
}
