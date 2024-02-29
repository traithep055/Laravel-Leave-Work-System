<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    .content-container {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    
    .card-hover:hover {
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
          transform: translateY(-5px);
          transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
      }
</style>

<body>
    @extends('layouts.master')

@section('content')
<div class="content-container">
    <div class="content-container">
        <div>
            <h1 class="headline">ยินดีต้อนรับ, {{ $data->first_name ?? 'Not set'}} {{ $data->last_name ?? 'Not set'}}!</h1>

          <p>บริษัท PMS จำกัดดดด</p>

        </div>
      </div>
</div>

    <div class="container">
      <h1>ข่าวที่น่าสนใจ</h1>
      @if($articles)
          <div class="row">
              @foreach ($articles as $article)
                  <div class="col-md-4">
                      <div class="card card-hover">
                          <img src="{{ $article['urlToImage'] ?? 'No image' }}" class="card-img-top" alt="News Image">
                          <div class="card-body">
                              <h5 class="card-title">{{ $article['title'] ?? 'No title' }}</h5>
                              <p class="card-text">{{ $article['description'] ?? 'No description' }}</p>
                              <a href="{{ $article['url'] ?? '#' }}" class="btn btn-primary">อ่านเพิ่มเติม</a>
                          </div>
                      </div>
                  </div>
              @endforeach
          </div>
      @else
          <p>ไม่มีข้อมูลข่าว</p>
      @endif
  </div>
@endsection
</body>
</html>

