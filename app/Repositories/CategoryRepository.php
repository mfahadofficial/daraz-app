<?php
namespace App\Repositories;
use App\Models\Category;

class CategoryRepository extends BaseRepository
{
    protected $entity;

    public function __construct()
    {
        $this->entity = Category::class;
    }

    public function allCategory(string $sortBy = 'created_at', string $sortOrder = 'desc')
    {
        return $this->entity::orderBy($sortBy, $sortOrder)
            ->get();
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



}