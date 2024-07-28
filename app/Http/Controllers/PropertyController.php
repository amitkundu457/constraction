<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Models\Unit;
use App\Models\Agent;
use App\Models\Contruct;
use App\Models\Document;
use App\Models\Property;
use App\Models\PropertyAmenity;
use App\Models\PropertyType;
use Illuminate\Http\Request;
use App\Models\PropertyDocument;



class PropertyController extends Controller
{
    public function index()
    {
        $title = "Property";
        // Retrieve all properties from the database and return them in a view
        $properties = Property::leftJoin('units', 'units.id', '=', 'properties.unit_id')->join('property_types', 'property_types.id', '=', 'properties.property_type')
            ->join('contructs', 'contructs.id', '=', 'properties.contract_type')
            ->select('properties.id', 'properties.title', 'units.name', 'contructs.contruct_name as contract_type', 'property_types.type_name as property_type', 'properties.created_at', 'properties.status')->latest()->paginate(10);
        $unit = Unit::all();
        $type = PropertyType::all();
        $contruct = Contruct::all();
        $agents = Agent::all();
        $amenities = PropertyAmenity::all();
        return view('property/property', compact('amenities','agents','properties', 'title', 'contruct', 'type', 'unit',));
    }


    public function propertyStore(Request $request)
    {
        
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->move(public_path('photo'), $fileName);
            // Adjust the field name as necessary
        } else {
            $imageName = '';
        }

        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $documentName = time() . '.' . $document->getClientOriginalName();
            $document->move(public_path('document'), $documentName);
            // Adjust the field name as necessary
        } else {
            $documentName = '';
        }

        if ($request->hasFile('plan')) {
            $plan = $request->file('plan');
            $planName = time() . '.' . $plan->getClientOriginalName();
            $plan->move(public_path('document'), $planName);
            // Adjust the field name as necessary
        } else {
            $planName = '';
        }

        $property = new Property();
        $property->agency_id = $request->agency_id;
        $property->property_type = $request->property_type;
        $property->contract_type = $request->contract_type;
        $property->unit_id = $request->unit_id;
        $property->property_feature_id = $request->property_feature_id;
        $property->built_year = $request->built_year;
        $property->title = $request->title;
        $property->address = $request->address;
        $property->location = $request->location;
        $property->price = $request->price;
        $property->area = $request->area;
        $property->floor = $request->floor;
        $property->bedroom = $request->bedroom;
        $property->document =  "test";
        $property->photo =  "test";
        $property->plan =  "test";
        $property->status = $request->status;
        $property->amenities = $request->amenities;
        $property->save();
        // dd($fileName);
        $documents = new PropertyDocument();
        $documents->property_id = $property->id;
        $documents->document =  $documentName;
        $documents->photo =  $fileName;
        $documents->plan =  $planName;
        $documents->save();


        // dd($documents);
        return back()->with('success', $property->title . 'property created successfully');
    }

    public function propertyEdit($id)
    {
    }
    public function propertyUpdate(Request $request, $id)
    {
    }
    public function propertyDelete($id)
    {
        $property = Property::find($id);
        $property->delete();
        return back()->with('success', $property->title . ' property deleted successfully');
    }

    public function propertyType()
    {
        $title = "property type";
        $type = PropertyType::paginate(10);
        $plots = Plot::all();
        return view('property/propertyType', compact('type', 'title','plots'));
    }

    public function propertyTypeStore(Request $request)
    {
        $type = new PropertyType();
        $type->type_name = $request->type_name;
        $type->plot_id = $request->plot_id;
        $type->note = $request->note;
        $type->save();
        return back()->with('success', $type->type_name . 'property type created successfully');
    }

    public function propertyTypeEdit($id)
    {
        $type = PropertyType::find($id);
        return view('backend/propertyTypeEdit', compact('type'));
    }
    public function propertyTypeUpdate(Request $request, $id)
    {
        $type = PropertyType::find($id);
        $type->type_name = $request->type_name;
        $type->plot_id = $request->plot_id;
        $type->note = $request->note;
        $type->save();
        return back()->with('success', $type->type_name . 'property type updated successfully');
    }

    public function propertytypeDelete($id)
    {
        $type = PropertyType::find($id);
        $type->delete();
        return back()->with('success', $type->type_name . 'property type deleted successfully');
    }


    public function propertyContruct()
    {
        $title = "Contract";
        // Retrieve all contract types from the database and return them in a view
        $contract = Contruct::all();
        return view('property/propertyContruct', compact('contract', 'title'));
    }

    public function propertyContractStore(Request $request)
    {
        $contract = new Contruct();
        $contract->contruct_name = $request->contruct_name;

        $contract->save();
        return back()->with('success', $contract->contruct_name . 'contract type created successfully');
    }

    public function propertyContractEdit($id)
    {
    }
    public function propertyContractUpdate(Request $request, $id)
    {
        $contract = Contruct::find($id);
        $contract->contruct_name = $request->contruct_name;
        $contract->save();
        return back()->with('success', $contract->contruct_name . 'contract type updated successfully');
    }

    public function propertyContractDelete($id)
    {
        $contract = Contruct::find($id);
        $contract->delete();
        return back()->with('success', $contract->contruct_name . 'contract type deleted successfully');
    }


    public function propertyunit()
    {
        $title = "Unit";
        // Retrieve all unit types from the database and return them in a view
        $unit = Unit::all();
        return view('property/propertyUnit', compact('unit', 'title'));
    }

    public function propertyUnitStore(Request $request)
    {
        $unit = new Unit();
        $unit->name = $request->name;
        $unit->save();
        return back()->with('success', $unit->name . 'unit type created successfully');
    }

    public function propertyUnitEdit($id)
    {
    }
    public function propertyUnitUpdate(Request $request, $id)
    {
        $unit = Unit::find($id);
        $unit->name = $request->name;
        $unit->save();
        return back()->with('success', $unit->name . 'unit type updated successfully');
    }
    public function propertyUnitDelete($id)
    {
        $unit = Unit::find($id);
        $unit->delete();
        return back()->with('success', $unit->name . 'unit type deleted successfully');
    }

    public function propertyphoto($id)
    {
        $title = "Property Photo";
        // Retrieve all unit types from the database and return them in a view
        $pro = Property::find($id);
        // dd($pro);
        $photo = PropertyDocument::all();
        // dd($photo);
        return view('backend/propertyPhoto', compact('photo', 'title', 'pro'));
    }

    public function propertyphotoStore(Request $request)
    {
        // dd($request->id);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = $file->getClientOriginalName();
            $filePath = $file->move(public_path('photo'), $fileName);
            // Adjust the field name as necessary
        } else {
            $imageName = '';
        }
        $photo = new PropertyDocument();
        $photo->property_id = $request->property_id;
        $photo->photo =  $fileName;

        $photo->save();
        // dd($photo);
        return back()->with('success', 'Property Photo uploaded successfully');
    }
    public function propertyphotoEdit($id)
    {
    }
    public function propertyphotoUpdate(Request $request, $id)
    {
    }
    public function propertyphotoDelete($id)
    {
        $photo = PropertyDocument::find($id);
        $photo->delete();
        return back()->with('success', 'Property Photo deleted successfully');
    }


    public function propertydocument($id)
    {
        $title = "Property Document";
        // Retrieve all unit types from the database and return them in a view
        $pro = Property::find($id);
        // dd($pro);
        $document = PropertyDocument::all();
        // dd($document);
        return view('property/propertyDocument', compact('document', 'title', 'pro'));
    }

    public function propertydocumentStore(Request $request)
    {
        // dd($request->id);
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $documentName = time() . '.' . $document->getClientOriginalName();
            $document->move(public_path('document'), $documentName);
            // Adjust the field name as necessary
        } else {
            $documentName = '';
        }
        $document = new PropertyDocument();
        $document->property_id = $request->property_id;
        $document->document =  $documentName;

        $document->save();
        // dd($document);
        return back()->with('success', 'Property Document uploaded successfully');
    }

    public function download($id)
    {
        $filePath = 'public/document/' . $id; // Adjust the path based on where the files are stored


        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return redirect()->back()->with('error', 'File not found.');
    }

    public function propertyamenity(){
        $amenities = PropertyAmenity::all();
        return view('property.propertyAmenity',\compact('amenities'));
    }

    public function propertyAmenityStore(Request $request){
        $amenity = new PropertyAmenity();
        $amenity->name = $request->name;
        $amenity->save();
        return redirect()->back()->with('success', 'New amenity added');
    }

    // public function property
}
