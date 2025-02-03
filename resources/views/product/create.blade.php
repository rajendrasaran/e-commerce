@extends('layout.admin')
<style>
  .col-6 {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
    margin-left: 30%;
    margin-top: 90px;
  }
</style>
@section('page_content')

<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white me-2">
      <i class="mdi mdi-home"></i>
    </span> Add Product Here!
  </h3>
</div>
<div class="form-group">
  <div class="col-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Add Product</h4>
        <form class="forms-sample" action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleInputParentId">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="exampleInputParentId" placeholder="Name">
            @error('name')
            <span style="color:red;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="exampleInputStatus">Status</label>
            <select name="status" id="exampleInputStatus" class="form-control">
              <option value="">Select Status</option>
              <option value="1">Enable</option>
              <option value="2">Disable</option>
            </select>
            @error('status')
            <span style="color:red;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="exampleInputShowMenu">Featured</label>
            <select name="is_featured" id="exampleInputShowMenu" class="form-control">
              <option value="">Select Featured</option>
              <option value="1">Yes</option>
              <option value="2">No</option>
            </select>
            @error('is_featured')
            <span style="color:red;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="exampleInputParentId">Sku</label>
            <input type="number" name="sku" value="{{ old('sku') }}" class="form-control" id="exampleInputParentId" placeholder="Sku">
            @error('sku')
            <span style="color:red;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="exampleInputParentId">Quintity</label>
            <input type="number" name="qty" value="{{ old('qty') }}" class="form-control" id="exampleInputParentId" placeholder="Quintity">
            @error('qty')
            <span style="color:red;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="exampleInputStatus">Stock Status</label>
            <select name="stock_status" id="exampleInputStatus" class="form-control">
              <option value="">Select Stock Status</option>
              <option value="1">Yes</option>
              <option value="2">No</option>
            </select>
            @error('stock_status')
            <span style="color:red;">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group">
            <label for="exampleInputParentId">Weight</label>
            <input type="number" name="weight" value="{{ old('weight') }}" class="form-control" id="exampleInputParentId" placeholder="Weight">
            @error('weight')
            <span style="color:red;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="exampleInputName1">Related Product</label><br>
            <div class="scroll-role">
              @foreach($product as $_product)
              <input type="checkbox" name="related_product[]" id="{{ $_product->name }}" value="{{ $_product->id }}">
              <label for="{{ $_product->name }}" style="vertical-align:0;">{{ $_product->name }}</label><br>
              @endforeach
              @error('related_product')
              <span style="color:red;">{{ $message }}</span>
              @enderror
            </div>
            @foreach($attributes as $att)
            <div class="form-group">
              <label for="exampleInputName1">{{ $att->name }}</label><br>
              <div class="scroll-role" style="margin-top:3px 0px;">
                @php
                $attributeName = $att->name;
                @endphp
                @foreach($att->attributeValues as $_value)
                <input type="hidden" name="product_attributes[{{ $att->id }}][attribute_id]" value="{{ $att->id }}">
                <input type="checkbox" name="product_attributes[{{ $att->id }}][value_id][]" id="{{ $_value->name }}" value="{{ $_value->id }}" @if(is_array(old("product_attributes.$att->id.value_id")) && in_array($_value->id, old("product_attributes.$att->id.value_id")))
                checked
                @endif
                >
                <label for="{{ $_value->name }}" style="vertical-align:0;">{{ $_value->name }}</label><br>
                @endforeach
              </div>
              @error('product_attributes.'.$att->id.'.value_id')
              <span style="color:red;">{{ str_replace('The product_attributes.'.$att->id.'.value_id', $att->name, $message) }}</span>
              @enderror
              @endforeach


              <div class="form-group">

                <label for="exampleInputParentId">Price</label>
                <input type="number" name="price" value="{{ old('price') }}" class="form-control" id="exampleInputParentId" placeholder="Price">
                @error('price')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="exampleInputParentId">Special Price</label>
                <input type="number" name="special_price" value="{{ old('special_price') }}" class="form-control" id="exampleInputParentId" placeholder="Special Price">
                @error('special_price')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>

              

              <div class="form-group">
                <label for="exampleInputParentId">Special Price To</label>
                <input type="date" name="special_price_from" value="{{ old('special_price_from') }}" class="form-control">
                @error('special_price_from')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="exampleInputParentId">Special Price To</label>
                <input type="date" name="special_price_to" value="{{ old('special_price_to') }}" class="form-control">
                @error('special_price_to')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Category</label><br>
                <div class="scroll-role">
                  @foreach($category as $_category)
                  <input type="checkbox" name="categories[]" id="{{ $_category->name }}" value="{{ $_category->id }}">
                  <label for="{{ $_category->name }}" style="vertical-align:0;">{{ $_category->name }}</label><br>
                  @endforeach
                </div>
                @error('categories')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="short_description">Short Description</label>
                <textarea name="short_description" id="short_description" cols="1" rows="1" class="form-control" placeholder="Short Description">{{old('short_description')}}</textarea>
                @error('short_description')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="exampleInputDescription">Description</label>
                <textarea name="description" id="description" cols="1" rows="1" class="form-control" placeholder="Description">{{old('description')}}</textarea>
                @error('description')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Images</label>
                <div class="form-control">
                  <input type="file" id="exampleInputName1" name="image[]" multiple>
                </div>
                @error('image')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="exampleInputName1">Url Key</label>
                <input type="text" name="url_key" value="{{ old('url_key') }}" class="form-control" id="exampleInputName1" placeholder="Optional">
                @error('url_key')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <textarea name="meta_title" id="meta_title" cols="1" rows="1" class="form-control" placeholder="Meta Title">{{old('meta_title')}}</textarea>
                @error('meta_title')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="meta_keyword">Meta Keyword</label>
                <textarea name="meta_keyword" id="meta_keyword" cols="1" rows="1" class="form-control" placeholder="Meta Keyword">{{old('meta_keyword')}}</textarea>
                @error('meta_keyword')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>

              <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea name="meta_description" id="meta_description" cols="1" rows="1" class="form-control" placeholder="Meta Description">{{old('meta_description')}}</textarea>
                @error('meta_description')
                <span style="color:red;">{{ $message }}</span>
                @enderror
              </div>

              <input type="submit" name="submit" value="Submit" class="btn btn-gradient-primary me-2">
              <button class="btn btn-gradient-primary me-2"><a href="{{ route('product.index') }}" style="color:white;">Back</a></button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection