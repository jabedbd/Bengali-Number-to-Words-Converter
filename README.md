# Bengali Number to Words Converter

A PHP class that converts numerical values to their Bengali word representation. This library provides accurate conversion of numbers to Bengali words, supporting values from zero to crores (tens of millions) including negative numbers.

## Features

- Converts numbers to Bengali words (বাংলা শব্দ)
- Supports numbers from 0 to 99,99,99,999 (99 crore)
- Handles negative numbers
- Properly manages Bengali number scales (শত, হাজার, লক্ষ, কোটি)
- Special handling for teen numbers (11-19)
- Built-in error handling
- No external dependencies

## Installation

1. Copy the `BengaliNumberToWords.php` file to your project
2. Include the class in your PHP file:

```php
require_once 'path/to/BengaliNumberToWords.php';
```

## Usage

### Basic Usage

```php
$converter = new BengaliNumberToWords();

// Convert simple numbers
echo $converter->convert(0);    // Output: শূন্য
echo $converter->convert(5);    // Output: পাঁচ
echo $converter->convert(-10);  // Output: ঋণাত্মক দশ

// Convert larger numbers
echo $converter->convert(1234);    // Output: এক হাজার দুইশত চৌত্রিশ
echo $converter->convert(100000);  // Output: এক লক্ষ
echo $converter->convert(1000000); // Output: দশ লক্ষ
```

### Example Conversions

| Number | Bengali Word |
|--------|-------------|
| 0 | শূন্য |
| 5 | পাঁচ |
| 10 | দশ |
| 15 | পনেরো |
| 20 | বিশ |
| 100 | একশত |
| 1,000 | এক হাজার |
| 100,000 | এক লক্ষ |
| 1,000,000 | দশ লক্ষ |
| 10,000,000 | এক কোটি |

## Error Handling

The class includes built-in error handling for invalid inputs:

```php
try {
    $converter->convert("invalid"); // Throws InvalidArgumentException
} catch (InvalidArgumentException $e) {
    echo $e->getMessage(); // Output: "Input must be a number"
}
```

## Scale Reference

The converter uses the following Bengali number scales:

- শত (Hundred): 100
- হাজার (Thousand): 1,000
- লক্ষ (Lakh): 100,000
- কোটি (Crore): 10,000,000

## Technical Details

### Class Structure

The class uses several private arrays to store Bengali number words:

- `$units`: Single digit numbers (0-9)
- `$tens`: Multiples of 10 (10-90)
- `$teens`: Special cases for 11-19
- `$scales`: Number scales (hundred, thousand, lakh, crore)

### Methods

- `convert($number)`: Main public method to convert numbers to words
- `convertLessThanThousand($number)`: Helper method for processing numbers under 1000

## Requirements

- PHP 7.0 or higher
- UTF-8 encoding support

## Limitations

- Maximum supported number is 99 crore (990,000,000)
- Decimal numbers are not supported
- Requires proper UTF-8 encoding support for Bengali characters

## Contributing

Feel free to submit issues and enhancement requests!

## License

This project is licensed under the MIT License - see the LICENSE file for details.

## Acknowledgments

- Inspired by the Bengali number system and its traditional counting methods
- Developed with attention to Bengali linguistic conventions

## Support

For issues, questions, or contributions, please open an issue in the repository.
