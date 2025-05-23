<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Past classes</title>
    <style>
        .container{
            display: grid;
            grid-template-areas: 
                "header heaeder"
                "menu content"
                "footer footer";
            grid-template-columns: 1fr 3fr;
            gap: 5px;
            background-color: rgb(143, 15, 40);
            padding: 5px;
            width: 1000px;
        }

        .container > div {
            background-color: rgb(239, 144, 169);
            padding: 10px;
        }

        .container > div.header {
            grid-area: header;
            text-align: center;
        }

        .container > div.menu {
            grid-area: menu;
        }

        .container > div.content {
            grid-area: content;
        }

        .container > div.footer {
            grid-area: footer;
        }
    </style>
</head>

<body>
    <h1> CSS GRID LAYOUT </h1>

    <div class="container">
        <div class="header"><h2>My header</h2></div>
        <div class="menu"><a href="#"> link 1</a><br><a href="#"> link 2</a><br>
            <a href="#"> link 3</a>
        </div>
        <div class="content"><h3>content</h3>
            <p>Lorem ipsum nkodor amet, consectetuer adipiscing elit. Ridiculus sit nisl laoreet facilisis aliquet. Potenti dignissim litora eget montes rhoncus sapien neque urna. Cursus libero sapien integer magnis ligula lobortis quam ut.
            </p>
        </div>
        <div class="content" style="position: relative; top: 25px;"><h3>content</h3>
            <p>Lorem ipsum odjor amet, consectetuer adipiscing elit. Ridiculus sit nisl laoreet facilisis aliquet. Potenti dignissim litora eget montes rhoncus sapien neque urna. Cursus libero sapien integer magnis ligula lobortis quam ut.
            </p>
        </div>
        <div class="content"><h3>content</h3>
            <p>Lorem ipsum odojhr amet, consectetuer adipiscing elit. Ridiculus sit nisl laoreet facilisis aliquet. Potenti dignissim litora eget montes rhoncus sapien neque urna. Cursus libero sapien integer magnis ligula lobortis quam ut.
            </p>
        </div>
        <div class="footer"><h4>Footer</h4></div>
    </div>
</body>