<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>商品出品ページ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">商品出品ページ</h1>

        <form action="{{ route('item.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">商品名</label>
                <input type="text" name="name" class="form-control" id="name" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">価格</label>
                <input type="number" name="price" class="form-control" id="price" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">説明</label>
                <textarea name="description" class="form-control" id="description" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="condition" class="form-label">状態</label>
                <select name="condition" class="form-select" id="condition" required>
                    <option value="良好">良好</option>
                    <option value="目立った傷や汚れなし">目立った傷や汚れなし</option>
                    <option value="やや傷や汚れあり">やや傷や汚れあり</option>
                    <option value="状態が悪い">状態が悪い</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">出品する</button>
        </form>

        <a href="{{ url('/') }}" class="btn btn-primary mt-3">一覧に戻る</a>
    </div>
</body>
</html>
