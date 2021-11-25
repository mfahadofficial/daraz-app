<?php
namespace App\Repositories;
use App\Models\Product;

class ProductRepository extends BaseRepository
{
    protected $entity;

    public function __construct()
    {
        $this->entity = Product::class;
    }

    public function allProduct(string $sortBy = 'created_at', string $sortOrder = 'desc')
    {
        return $this->entity::with('category')->orderBy($sortBy, $sortOrder)
            ->get();
    }

 
    public function create(array $data)
    {
        $model = $this->entity::create($data);

        return $model;
    }


    public function createDate($product_id, $dates)
    {
        $no_delete = [];

        foreach ($dates as $date) {
            $time = date('H:i:i', strtotime($date));
            $date = date('Y-m-d', strtotime($date));

            $date_val = $this->entityDate::where('product_id', $product_id)->where('date', $date)->where('time', $time)->first();

            if (is_null($date_val)) {
                $date_val = $this->entityDate::create([
                    'product_id' => $product_id,
                    'date' => $date,
                    'time' => $time
                ]);
            }

            $no_delete[] = $date_val->id;
        }

        $this->entityDate::whereNotIn('id', $no_delete)->where('product_id', $product_id)->delete();
    }



    public function update(int $id, array $data)
    {
        // return response()->json(['name' => 'Abigail', 'state' => 'CA']);
        $model = $this->find($id);

        // if ($model->photo != $data['photo']) {
        //     $img = Image::make(Storage::get(str_replace('/storage/', '/public/', $data['photo'])))->fit(310, 256)->encode('png');

        //     $file_name = uniqid('thumbnail_') . '.png';
        //     if (Storage::put('public/uploads/' . $file_name, (string)$img->encode()))
        //         $data['photo_small'] = '/storage/uploads/' . $file_name;
        //     else
        //         $data['photo_small'] = '';
        // }

        $model->update($data);
        $model->save();

        return $model;
    }


    // public function search($tern)
    // {
       
    //     return $this->entity::orderBy('id', 'asc')->get();
    // }

    public function search($tern)
    {
        return $this->entity::Where('category_id', 'like', "%{$tern}%")->orWhere('name', 'like', "%{$tern}%")->get();
    }

}