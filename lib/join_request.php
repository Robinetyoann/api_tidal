<?php

function linkTables($links, $sources, $targets, $idSource, $idTarget, $name) {
    foreach($sources as &$source) {
        foreach($links as $link) {
            if($link[$idSource] == $source[$idSource]) {
                $source[$name][] = [$idTarget => $link[$idTarget]];
            }
        }
        foreach($source[$name] as &$sourceMeta) {
            foreach($targets as $target) {
                if($sourceMeta[$idTarget] == $target[$idTarget])
                    $sourceMeta = $target;
            }
        }
    }
    return $sources;
}
