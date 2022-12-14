<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request('search')) {
            $paginate = Menu::where('id', 'like', '%' . request('search') . '%')
                ->orwhere('name', 'like', '%' . request('search') . '%')
                ->orwhere('price', 'like', '%' . request('search') . '%')
                ->orwhere('stock', 'like', '%' . request('search') . '%')
                ->paginate(5);
            return view('employee.staff-dapur.menu.index', ['paginate' => $paginate]);
        } else {
            $menu = Menu::all();
            $paginate = Menu::orderBy('id', 'asc')->paginate(5);
            return view('employee.staff-dapur.menu.index', ['menu' => $menu, 'paginate' => $paginate]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.staff-dapur.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'type' => 'required',
        ]);

        // if ($request->file('image')) {
        //     $image_name = $request->file('image')->store('images', 'public');
        // } else {
        //     $image_name = NULL;
        // }

        if ($request->file('image')) {
            $image_name = $request->file('image');
            // $image_name = $request->file('image')->store('images', 'public');
            $storage = new StorageClient([
                'keyFilePath' => public_path('key.json')
            ]);

            $bucketName = env('GOOGLE_CLOUD_BUCKET');
            $bucket = $storage->bucket($bucketName);

            //get filename with extension
            $filenamewithextension = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
            // $filenamewithextension = $request->file('image')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('image')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename . '_' . uniqid() . '.' . $extension;

            Storage::put('public/uploads/' . $filenametostore, fopen($request->file('image'), 'r+'));

            $filepath = storage_path('app/public/uploads/' . $filenametostore);

            $object = $bucket->upload(
                fopen($filepath, 'r'),
                [
                    'predefinedAcl' => 'publicRead'
                ]
            );

            // delete file from local disk
            Storage::delete('public/uploads/' . $filenametostore);
        }
        // if ($request->file('foto')) {
        //     $image_name = $request->file('foto')->store('images', 'public');
        // }


        $menu = new Menu;
        $menu->name = $request->get('name');
        $menu->price = $request->get('price');
        $menu->stock = $request->get('stock');
        $menu->type = $request->get('type');
        $menu->menu_photo_path = $filenametostore;
        $menu->save();

        return redirect()->route('menu.index')
            ->with('success', 'Menu Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = Menu::where('id', $id)->first();
        return view('employee.staff-dapur.menu.detail', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::where('id', $id)->first();
        return view('employee.staff-dapur.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'type' => 'required',
        ]);

        $storage = new StorageClient([
            'keyFilePath' => public_path('key.json')
        ]);

        $menu = Menu::find($id);

        $menu->name = $request->get('name');
        $menu->price = $request->get('price');
        $menu->stock = $request->get('stock');
        $menu->type = $request->get('type');
        $menu->save();

        $bucketName = env('GOOGLE_CLOUD_BUCKET');
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->object($menu->menu_photo_path);

        if ($request->file('image')) {
            if ($menu->menu_photo_path && $object != null) {
                $object->delete();
                //get filename with extension
                $filenamewithextension = pathinfo($request->file('image')->getClientOriginalName(), PATHINFO_FILENAME);
                // $filenamewithextension = $request->file('image')->getClientOriginalName();

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                //get file extension
                $extension = $request->file('image')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $filename . '_' . uniqid() . '.' . $extension;

                Storage::put('public/uploads/' . $filenametostore, fopen($request->file('image'), 'r+'));

                $filepath = storage_path('app/public/uploads/' . $filenametostore);

                $object = $bucket->upload(
                    fopen($filepath, 'r'),
                    [
                        'predefinedAcl' => 'publicRead'
                    ]
                );

                // delete file from local disk
                Storage::delete('public/uploads/' . $filenametostore);
            }

            $image_name = $filenametostore;
        } else {
            $image_name = $menu->menu_photo_path;
        }
        $menu->menu_photo_path = $image_name;
        $menu->save();

        return redirect()->route('menu.index')
            ->with('success', 'Menu Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $storage = new StorageClient([
            'keyFilePath' => public_path('key.json')
        ]);

        $menu = Menu::find($id);

        $bucketName = env('GOOGLE_CLOUD_BUCKET');
        $bucket = $storage->bucket($bucketName);
        $object = $bucket->object($menu->menu_photo_path);



        $object->delete();
        $menu->delete();

        // Menu::where('id', $id)->delete();

        return redirect()->route('menu.index')
            ->with('success', 'Menu Deleted Successfully');
    }

    public function allMenus()
    {
        $data = Menu::where('type', 'beverage')->paginate(9);
        $foodMenus = Menu::where('type', 'food')->paginate(9);
        return view('user.menus', compact('data', 'foodMenus'));
    }

    public function getBeverageData(Request $request)
    {
        if ($request->ajax()) {
            if ($request->get('query') != '') {
                $data = Menu::where('type', 'beverage')
                    ->where('name', 'like', '%' . $request->get('query') . '%')
                    ->paginate(9);

                return view('user.beverage-paginate', compact('data'))->render();
            } else {
                $data = Menu::where('type', 'beverage')->paginate(9);

                return view('user.beverage-paginate', compact('data'));
            }
        }
    }

    public function getFoodData(Request $request)
    {
        if ($request->ajax()) {
            if ($request->get('query') != '') {
                $menus = Menu::where('type', 'food')
                    ->where('name', 'like', '%' . $request->get('query') . '%')
                    ->paginate(9);

                return view('user.food-paginate', ['foodMenus' => $menus])->render();
            } else {
                $menus = Menu::where('type', 'food')->paginate(9);

                return view('user.food-paginate', ['foodMenus' => $menus]);
            }
        }
    }

    public function getMenu(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $menu = Menu::find($id);
            // dd($menu);
            // $jsonVar = response()->json($menu);
            // dd(json_decode($menu));

            return response()->json([
                'menu' => $menu
            ]);
        }
    }

    public function getAllMenus(Request $request)
    {
        if ($request->ajax()) {
            $menu = Menu::all();

            // dd(json_decode($menu));
            return response()->json([
                'menus' => $menu,
            ]);

            // dd($data);
        }
    }
}
