@extends('layouts.app')
@section('title', $products->title)

@section('content')
    <div class="row">
        <div class="col-lg-10 col-lg-offset-1">
            <div class ="panel panel-default">
                <div class="panel-body product-info">
                    <div class="row">
                        <div class = "col-sm-5">
                            <img class="cover" src="{{ $products->image_url }}" alt="">
                        </div>
                        <div class="col-sm-7">
                            <div class="title">{{ $products->title }}</div>
                            <div class="price"><label>价格</label><em>¥</em><span>{{ $products->price }}</span></div>
                            <div class="sales_and_reviews">
                                <div class="sold_count">累计销量<span class="count">{{ $products->sold_count }}</span></div>
                                <div class="review_count">累计评价<span class="count">{{ $products->review_count }}</span></div>
                                <div class="rating" title="评分 {{ $products->rating }}">评分 <span class="count">{{ str_repeat('★', floor($products->rating)) }}{{ str_repeat('☆', 5 - floor($products->rating)) }}</span></div>
                            </div>
                            <div class="skus">
                                <label>选择</label>
                                <div class="btn-group" data-toggle="buttons">
                                    @foreach($products->skus as $sku)
                                        <label class="btn btn-default sku-btn"
                                               data-price = "{{ $sku->price }}"
                                               daata-stock = "{{ $sku->stock }}"
                                               data-toggle="tooltip"
                                               title="{{ $sku->discription }}"
                                                data-placement="bottom">
                                            <input type="radio" name="skus" autocomplete="off" value="{{ $sku->id }}"/> {{ $sku->title }}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                            <div class="cart_amount"><label>数量</label><input type="text" class="form-control input-sm" value="1"><span>件</span><span class="stock"></span></div>
                            <div class="button">
                                <button class="btn btn-primary btn-favor">收藏</button>
                                <button class="btn btn-primary btn-add-to-cart">加入购物车</button>
                            </div>
                        </div>
                    </div>
                    <div class="product-detail">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#product-detail-tab" aria-controls="product-detail-tab" role="tab" data-toggle="tab">商品详情</a></li>
                            <li role="presentation"><a href="#product-reviews-tab" aria-controls="product-reviews-tab" role="tab" data-toggle="tab">用户评价</a></li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="product-detail-tab">
                                {!! $products->discription !!}
                            </div>
                            <div role="tabpanel" class="tab-pane" id="product-reviews-tab"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scriptAfterJs')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip({trigger: 'hover'});
            $('.sku-btn').click(function(){
                $('.product-info .price span').text($(this)).data('price');
                $('.product-info .stock').text('库存：' +$(this).data('stock')+'件');
            });
        });
    </script>
@endsection