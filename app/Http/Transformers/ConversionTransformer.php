<?PHP
namespace App\Http\Transformers;

use League\Fractal;
use App\Conversion;


class ConversionTransformer extends Fractal\TransformerAbstract {

    public function transform(Conversion $conversion) {

    return [
            'number' => $conversion->number,
            'roman'  => $conversion->roman,
			'timestamp' =>$conversion->created_at
        ];
    }
}
