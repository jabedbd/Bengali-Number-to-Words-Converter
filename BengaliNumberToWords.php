<?php

class BengaliNumberToWords {
    private $units = [
        '',
        'এক',
        'দুই',
        'তিন',
        'চার',
        'পাঁচ',
        'ছয়',
        'সাত',
        'আট',
        'নয়'
    ];

    private $tens = [
        '',
        'দশ',
        'বিশ',
        'তিরিশ',
        'চল্লিশ',
        'পঞ্চাশ',
        'ষাট',
        'সত্তর',
        'আশি',
        'নব্বই'
    ];

    private $scales = [
        '',
        'হাজার',
        'লক্ষ',
        'কোটি'
    ];

    private $teens = [
        'দশ',
        'এগারো',
        'বারো',
        'তেরো',
        'চৌদ্দ',
        'পনেরো',
        'ষোল',
        'সতেরো',
        'আঠারো',
        'উনিশ'
    ];

    public function convert($number) {
        if (!is_numeric($number)) {
            throw new InvalidArgumentException("Input must be a number");
        }

        if ($number < 0) {
            return 'ঋণাত্মক ' . $this->convert(abs($number));
        }

        if ($number == 0) {
            return 'শূন্য';
        }

        $words = [];
        
        // Handle crores (10 million)
        $crore = floor($number / 10000000);
        if ($crore > 0) {
            $words[] = $this->convertLessThanThousand($crore) . ' কোটি';
            $number %= 10000000;
        }

        // Handle lakhs (100 thousand)
        $lakh = floor($number / 100000);
        if ($lakh > 0) {
            $words[] = $this->convertLessThanThousand($lakh) . ' লক্ষ';
            $number %= 100000;
        }

        // Handle thousands
        $thousand = floor($number / 1000);
        if ($thousand > 0) {
            $words[] = $this->convertLessThanThousand($thousand) . ' হাজার';
            $number %= 1000;
        }

        // Handle hundreds
        $hundred = floor($number / 100);
        if ($hundred > 0) {
            $words[] = $this->units[$hundred] . ' শত';
            $number %= 100;
        }

        // Handle remaining two digits
        if ($number > 0) {
            if ($number < 20) {
                $words[] = $this->teens[$number % 10];
            } else {
                $ten = floor($number / 10);
                $unit = $number % 10;
                if ($unit > 0) {
                    $words[] = $this->units[$unit];
                }
                $words[] = $this->tens[$ten];
            }
        }

        return implode(' ', $words);
    }

    private function convertLessThanThousand($number) {
        if ($number < 100) {
            if ($number < 20) {
                return $this->teens[$number % 10];
            } else {
                $ten = floor($number / 10);
                $unit = $number % 10;
                if ($unit > 0) {
                    return $this->units[$unit] . ' ' . $this->tens[$ten];
                }
                return $this->tens[$ten];
            }
        }

        $hundred = floor($number / 100);
        $remainder = $number % 100;
        $words = [$this->units[$hundred] . ' শত'];
        
        if ($remainder > 0) {
            if ($remainder < 20) {
                $words[] = $this->teens[$remainder % 10];
            } else {
                $ten = floor($remainder / 10);
                $unit = $remainder % 10;
                if ($unit > 0) {
                    $words[] = $this->units[$unit];
                }
                $words[] = $this->tens[$ten];
            }
        }

        return implode(' ', $words);
    }
}
