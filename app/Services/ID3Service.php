<?php

namespace App\Services;

class ID3Service
{
    private function entropy($data)
    {
        // hitung entropi
        $total = count($data);
        $counts = [];

        foreach ($data as $item) {
            $label = $item['status_gizi'];
            if (!isset($counts[$label])) $counts[$label] = 0;
            $counts[$label]++;
        }

        $entropy = 0;
        foreach ($counts as $count) {
            $p = $count / $total;
            $entropy -= $p * log($p, 2);
        }

        return $entropy;
    }

    private function informationGain($data, $attribute)
    {
        $total = count($data);
        $subset = [];

        foreach ($data as $item) {
            $key = $item[$attribute];
            if (!isset($subset[$key])) $subset[$key] = [];
            $subset[$key][] = $item;
        }

        $gain = $this->entropy($data);
        foreach ($subset as $items) {
            $gain -= (count($items) / $total) * $this->entropy($items);
        }


        return $gain;
    }


    public function buildTree($data, $attributes)
    {
        $labels = array_column($data, 'status_gizi');
        if (count(array_unique($labels)) === 1) {
            return $labels[0];
        }

        if (empty($attributes)) {
            return array_reduce($labels, function ($a, $b) use (&$counts) {
                $counts[$a] = ($counts[$a] ?? 0) + 1;
                return $a;
            }, $labels[0]);
        }


        $bestAttr = null;
        $bestGain = 0;
        foreach ($attributes as $attr) {
            $gain = $this->informationGain($data, $attr);
            if ($gain > $bestGain) {
                $bestGain = $gain;
                $bestAttr = $attr;
            }
        }

        if (!$bestAttr) return null;

        $tree = ['attribute' => $bestAttr, 'nodes' => []];

        $groups = [];
        foreach ($data as $item) {
            $val = $item[$bestAttr];
            $groups[$val][] = $item;
        }

        $remainingAttr = array_filter($attributes, fn($a) => $a !== $bestAttr);

        foreach ($groups as $val => $subset) {
            $tree['nodes'][$val] = $this->buildTree($subset, $remainingAttr);
        }

        return $tree;
    }

    public function classify($tree, $sample)
    {
        while (is_array($tree)) {
            $attr = $tree['attribute'];
            $val = $sample[$attr] ?? null;
            if (!isset($tree['nodes'][$val])) return 'TIDAK DIKETAHUI';
            $tree = $tree['nodes'][$val];
        }

        return $tree;
    }


    public function testAccuracy($data, $attributes) {
        $correct = 0;
        $total = count($data);

        foreach ($data as $index => $testSample) {
            $trainingData = $data;
            unset($trainingData[$index]);

            $tree = $this->buildTree(array_values($trainingData), $attributes);

            $predicted =$this->classify($tree, $testSample);

            if ($predicted === $testSample['status_gizi']) {
                $correct++;
            }
        }


        return $total > 0 ? round(($correct / $total) * 100, 2) : 0;
    }

}
