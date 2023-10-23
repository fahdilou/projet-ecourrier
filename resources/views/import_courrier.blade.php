@extends('layouts.app')

@section('content')


<!-- Container fluid  -->
        <!-- ============================================================== -->
       
        
            <!-- row -->
            <div class="row">
             
              
            <form action="/import_courrier" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="excel_file">
    <button type="submit">Importer</button>
</form>

              
            </div>
        
          <!-- ============================================================== -->
        
         

            
@endsection
