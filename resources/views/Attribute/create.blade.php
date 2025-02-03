@extends('layout.admin')


@section('page_content')

<form action="{{route('attribute.store')}}" method="post" class="">
    @csrf
    <table class="Usertable table1">
        <tr>
            <td>name</td>
            <td class="td"><input type="text" name="name"></td>
        </tr>
        <tr>
            <td>Name_key</td>
            <td> <input class="td" type="text" name="name_key"></td>
        </tr>
        <tr>
            <td>is_variant</td>
            <td><select name="is_variant" id="">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>status</td>
            <td> <select name="status" id="">
                    <option value="1">Enable</option>
                    <option value="2">Dsable</option>
                </select></td>
        </tr>
        
            <tr>
                <th>attribute name</th>
                <th>attribute status</th>
                <th>Action</th>
            </tr>
            <tr>
                <td>
                    <input type="text" name="attribute_name[]" class="input">
                </td>
                <td>
                    <select name="attribute_status[]" class="selec">
                        <option value="1" required>Enable</option>
                        <option value="2" required>Disable</option>
                    </select>
                </td>
                <td>
                    <button type="button" class="add-more">Add More</button>
                </td>
            </tr>
            <tr>
                <td class="td"><input type="submit" value="submit"></td>
            </tr>
        </table>
</form>

<!-- Your JavaScript code -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $('.add-more').click(function() {
            var row = '<tr><td><input type="text" class="input" name="attribute_name[]"></td><td><select name="attribute_status[]" class="selec"><option value="1">Enable</option><option value="2">Disable</option></select></td><td><button type="button" class="remove">Remove</button></td></tr>';
            $('table').append(row);
        });

        $('table').on('click', '.remove', function() {
            $(this).closest('tr').remove();
        });

        $('form').validate();
    });
</script>


@endsection


@section('style')
<style>
    .td {
        width: 100%;
        float: left;
    }

    select {
        width: 100%;
        float: left;
        padding: 15px;
    }
</style>


@endsection