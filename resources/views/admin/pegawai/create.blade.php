@extends('admin.layout.appadmin')
@section('content')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


<h1 align="center">Form Tambah Pegawai</h1>

@if ($errors -> any())
<div>
  <ul>
    @foreach ($errors -> all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
</div>
@endif

<form method="POST" action="{{url('admin/pegawai/store')}}" enctype="multipart/form-data">
    {{csrf_field()}}
  <div class="form-group row">
    <label for="text1" class="col-4 col-form-label">NIP</label> 
    <div class="col-8">
      <input id="text1" name="nip" type="text" class="form-control @error('nip') is-invalid @enderror" placeholder="Masukan NIP">
      @error('nip')
      <div class="invalid-feedback">
      {{$message}}
      </div>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="text" class="col-4 col-form-label">Nama</label> 
    <div class="col-8">
      <input id="text" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukan Nama">
      @error('nama')
      <div class="invalid-feedback">
      {{$message}}
      </div>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="select" class="col-4 col-form-label">Jabatan</label> 
    <div class="col-8">
      <select id="select" name="jabatan_id" class="custom-select">
        @foreach($jabatan as $j)
        <option value="{{$j->id}}">{{$j->nama}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="select1" class="col-4 col-form-label">Divisi</label> 
    <div class="col-8">
      <select id="select1" name="divisi_id" class="custom-select">
      @foreach ($divisi as $d) 
      <option value="{{$d->id}}">{{$d->nama}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <div class="form-group row">
    <label class="col-4">Jenis Kelamin</label> 
    <div class="col-8">
      <div class="custom-control custom-radio custom-control-inline">
        <input name="gender" id="radio_0" type="radio" class="custom-control-input" value="L"> 
        <label for="radio_0" class="custom-control-label">Laki-Laki</label>
      </div>
      <div class="custom-control custom-radio custom-control-inline">
        <input name="gender" id="radio_1" type="radio" class="custom-control-input" value="P"> 
        <label for="radio_1" class="custom-control-label">Perempuan</label>
      </div>
      
    </div>
  </div>
  <div class="form-group row">
    <label for="text2" class="col-4 col-form-label">Tempat Lahir</label> 
    <div class="col-8">
      <input id="text2" name="tmp_lahir" type="text" class="form-control @error('tmp_lahir') is-invalid @enderror" placeholder="Masukan Tempat Lahir">
      @error('tmp_lahir')
      <div class="invalid-feedback">
      {{$message}}
      </div>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="text3" class="col-4 col-form-label">Tanggal Lahir</label> 
    <div class="col-8">
      <input id="text3" name="tgl_lahir" type="date" class="form-control @error('tgl_lahir') is-invalid @enderror" placeholder="Maukan Tanggal Lahir">
      @error('tgl_lahir')
      <div class="invalid-feedback">
      {{$message}}
      </div>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="text2" class="col-4 col-form-label">Kekayaan</label> 
    <div class="col-8">
      <input id="text2" name="kekayaan" type="text" class="form-control @error('kekayaan') is-invalid @enderror" placeholder="Masukan Harta Kekayaan">
      @error('kekayaan')
      <div class="invalid-feedback">
      {{$message}}
      </div>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <label for="textarea" class="col-4 col-form-label">Alamat</label> 
    <div class="col-8">
      <textarea id="textarea" name="alamat" cols="40" rows="5" class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group row">
    <label for="text4" class="col-4 col-form-label">Foto</label> 
    <div class="col-8">
      <input id="text4" name="foto" type="file" class="form-control">
    </div>
  </div> 
  <div class="form-group row">
    <div class="offset-4 col-8">
      <button name="submit" type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>



@endsection