<?php

class NaiveBayes {
    private $class_probabilities;
    private $feature_probabilities;

    // Fungsi untuk mengonversi nilai fitur menjadi nilai numerik
    private function convertFeatureValues($data) {
        // Kamus untuk mengonversi nilai fitur
        $feature_mapping = [
            "lebar & hijau" => 0,
            "tegak & tidak layu" => 1,
            "halus tanpa bercak" => 2,
            "mengkilap & sehat" => 3,
            "hijau tapi bercak" => 4,
            "lebar tapi kuning" => 5,
            "sempit & kuning" => 6,
            "layu" => 7,
            "rusak atau menggulung" => 8,
            "besar & lurus" => 0,
            "kulit batang mulus tanpa luka" => 1,
            "kuat & tidak rapuh" => 2,
            "berwarna coklat tua" => 3,
            "lurus tapi kecil" => 4,
            "besar tapi bengkok" => 5,
            "retak atau patah" => 6,
            "rapuh & kering" => 7,
            "90cm" => 0,
            "80cm" => 1,
            "70cm" => 2,
            "60cm" => 3,
            "50cm" => 4,
            "40cm" => 5,
            "30cm" => 6,
            "20cm" => 7,
            "10cm" => 8,
            "24 bulan" => 0,
            "18 bulan" => 1,
            "12 bulan" => 2,
            "11 bulan" => 3,
            "10 bulan" => 4,
            "9 bulan" => 5,
            "8 bulan" => 6,
            "7 bulan" => 7,
            "6 bulan" => 8,
            "5 bulan" => 9,
            "banyak & bercabang" => 0,
            "kuat & sehat" => 1,
            "tidak busuk" => 2,
            "tumbuh merata" => 3,
            "sedikit bercabang" => 4,
            "tidak bercabang" => 5,
            "akar busuk" => 6,
            "akar tipis atau pendek" => 7
        ];

        // Mengonversi nilai fitur dalam data
        $converted_data = [];
        foreach ($data as $key => $value) {
            if ($key == 'kualitas') continue; // Jangan mengonversi nilai status
            $value = strtolower($value); // Konversi nilai ke lower case
            $converted_data[$key] = isset($feature_mapping[$value]) ? $feature_mapping[$value] : $value;
        }

        return $converted_data;
    }

    public function train($data_latih) {
        $class_counts = [];
        $feature_counts = [];

        // Hitung probabilitas kelas dan fitur
        foreach ($data_latih as $data) {
            $kelas = $data['kualitas'];
            if (!isset($class_counts[$kelas])) {
                $class_counts[$kelas] = 0;
                $feature_counts[$kelas] = [];
            }
            $class_counts[$kelas]++;

            // Mengonversi nilai fitur
            $converted_data = $this->convertFeatureValues($data);

            foreach ($converted_data as $key => $value) {
                if (!isset($feature_counts[$kelas][$key])) {
                    $feature_counts[$kelas][$key] = [];
                }
                if (!isset($feature_counts[$kelas][$key][$value])) {
                    $feature_counts[$kelas][$key][$value] = 0;
                }
                $feature_counts[$kelas][$key][$value]++;
            }
        }

        $this->class_probabilities = [];
        $this->feature_probabilities = [];

        // Hitung probabilitas kelas
        $total_data = count($data_latih);
        foreach ($class_counts as $kelas => $count) {
            $this->class_probabilities[$kelas] = $count / $total_data;
        }

        // Hitung probabilitas fitur dengan smoothing Laplace
        foreach ($feature_counts as $kelas => $features) {
            $this->feature_probabilities[$kelas] = [];
            foreach ($features as $key => $values) {
                $this->feature_probabilities[$kelas][$key] = [];
                foreach ($values as $value => $count) {
                    $this->feature_probabilities[$kelas][$key][$value] = ($count + 1) / ($class_counts[$kelas] + count($values));
                }
            }
        }
    }

    // Fungsi untuk memprediksi kelas data baru
    public function predict($data) {
        // Mengonversi nilai fitur
        $converted_data = $this->convertFeatureValues($data);

        $class_scores = [];

        // Hitung skor untuk setiap kelas
        foreach ($this->class_probabilities as $kelas => $class_prob) {
            $class_scores[$kelas] = $class_prob;
            foreach ($converted_data as $key => $value) {
                if (isset($this->feature_probabilities[$kelas][$key][$value])) {
                    $class_scores[$kelas] *= $this->feature_probabilities[$kelas][$key][$value];
                } else {
                    // Gunakan nilai probabilitas yang sangat kecil
                    $class_scores[$kelas] *= 0.00001;
                }
            }
        }

        // Kelas dengan skor tertinggi adalah hasil prediksi
        $predicted_class = array_keys($class_scores, max($class_scores))[0];
        return $predicted_class;
    }

    // Fungsi untuk memprediksi kelas data baru dengan detail probabilitas
    public function predictDetail($data) {
        // Mengonversi nilai fitur
        $converted_data = $this->convertFeatureValues($data);

        $class_scores = [];

        // Hitung skor untuk setiap kelas
        foreach ($this->class_probabilities as $kelas => $class_prob) {
            $class_scores[$kelas] = $class_prob;
            foreach ($converted_data as $key => $value) {
                if (isset($this->feature_probabilities[$kelas][$key][$value])) {
                    $class_scores[$kelas] *= $this->feature_probabilities[$kelas][$key][$value];
                } else {
                    // Gunakan nilai probabilitas yang sangat kecil
                    $class_scores[$kelas] *= 0.00001;
                }
            }
        }

        // Normalisasi skor
        $total_score = array_sum($class_scores);
        foreach ($class_scores as $kelas => $score) {
            $class_scores[$kelas] /= $total_score;
        }

        return $class_scores;
    }
}
?>
