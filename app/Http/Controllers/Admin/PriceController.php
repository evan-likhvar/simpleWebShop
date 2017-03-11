<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
use App\paper;
use App\papercategory;
use Illuminate\Http\Request;
use SimpleXMLElement;

//use App\Http\Controllers\Controller;

class PriceController extends AdminController
{
    //
    public function index(Request $request)
    {

        //return dd($request->all());

        $parGrp = $this->parameterGroups;

        $ordered = 'id';
        $filter = 0;
        $order = 'desc';

        if (isset($request->sort)) {
            $ordered = $request->sort;
        }

        if (isset($request->order) && strlen($request->order) > 0) $order = $request->order;


        if (isset($request->filter) && $request->filter != 0) {
            $filter = $request->filter;
            $articles = Article::where('category_id', '=', $request->filter)->orderBy($ordered, $order)->paginate(20);
        } else {
            $filter = 0;
            $articles = Article::orderBy($ordered, $order)->paginate(20);
        }

        //$articles = Article::where('name','LIKE', $filter. '%')->orderBy($ordered,$order)->paginate(20);
        //$articles = Article::orderBy($ordered,$order)->paginate(20);


        $categories = Category::select('name', 'id')->get()->pluck('name', 'id')->toArray();

        //return dd($articles,$parGrp,$categories);


        return view('admin.articles.indexPrice')->with(compact('articles', 'parGrp', 'categories'));
    }

    public function hotLinePriceXML()
    {
        $xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<price>
    <date>fyjuy</date>
    <firmName>Мой КуперХантер</firmName>
    <firmId>1234</firmId>
    <categories>
        <category>
            <id>1</id>
            <name>Бытовая техника</name>
        </category>
        <category>
            <id>2</id>
            <parentId>1</parentId>
            <name>Климатическая техника</name>
        </category>
		<category>
            <id>3</id>
            <parentId>2</parentId>
            <name>Кондиционеры</name>
        </category>
    </categories>
    <items>
    </items>
</price>
XML;
        $hotLinePriceXML = new SimpleXMLElement($xmlstr);

        $hotLinePriceXML->date = date("Y-m-d H:i");

    $articles = Article::whereIn('category_id',[2,3,4,5,6,7,8])->get();
        foreach ($articles as $article) {
        $item = $hotLinePriceXML->items->addChild('item');
        $item->addChild('id', $article->id);
        $item->addChild('code', $article->nomer);
        $item->addChild('vendor', str_replace('&','&amp;',$article->Vendor->name));
        $item->addChild('name', $article->name);
        $item->addChild('description', $article->name);
        $item->addChild('url', 'http://www.куперхантер.укр/купить/'.$article->getArticleLink());
        $item->addChild('image', $_SERVER['APP_URL'].$article->getIntroImg('M'));
        $item->addChild('priceRUAH', $article->priceGRN);
        $item->addChild('stock', 'В наличии');
        }
        $path = public_path().'/XML/hotLinePrice.xml';
        fclose(fopen($path, "a+t"));
        $fnewsmap = fopen($path, "w+t");
        flock($fnewsmap, LOCK_EX);

        fwrite($fnewsmap, $hotLinePriceXML->asXML());
        fclose($fnewsmap);

        return redirect()->back();
    }

    public function priceUAPriceXML()
    {
        $xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<price>
    <date>fyjuy</date>
    <firmName>Мой КуперХантер</firmName>
    <firmId>1234</firmId>
    <categories>
        <category>
            <id>1</id>
            <name>Бытовая техника</name>
        </category>
        <category>
            <id>2</id>
            <parentId>1</parentId>
            <name>Климатическая техника</name>
        </category>
		<category>
            <id>3</id>
            <parentId>2</parentId>
            <name>Кондиционеры</name>
        </category>
    </categories>
    <items>
    </items>
</price>
XML;
        $hotLinePriceXML = new SimpleXMLElement($xmlstr);

        $hotLinePriceXML->date = date("Y-m-d H:i");

        $articles = Article::whereIn('category_id',[2,3,4,5,6,7,8])->get();
        foreach ($articles as $article) {
            $item = $hotLinePriceXML->items->addChild('item');
            $item->addChild('id', $article->id);
            $item->addChild('code', $article->nomer);
            $item->addChild('vendor', str_replace('&','&amp;',$article->Vendor->name));
            $item->addChild('name', $article->name);
            $item->addChild('description', $article->name);
            $item->addChild('url', 'http://www.куперхантер.укр/купить/'.$article->getArticleLink());
            $item->addChild('image', $_SERVER['APP_URL'].$article->getIntroImg('M'));
            $item->addChild('priceRUAH', $article->priceGRN);
            $item->addChild('stock', 'В наличии');
        }
        $path = public_path().'/XML/priceUA.xml';
        fclose(fopen($path, "a+t"));
        $fnewsmap = fopen($path, "w+t");
        flock($fnewsmap, LOCK_EX);

        fwrite($fnewsmap, $hotLinePriceXML->asXML());
        fclose($fnewsmap);

        return redirect()->back();
    }


    public function createSiteMap()
    {
        $sitemap = public_path().'/sitemap.txt';

        $sitename = $_SERVER["APP_URL"];
        $temp = $sitename."\r\n";
        //fwrite($temp, $sitename);

        $categories = Category::All();
        foreach ($categories as $category) {
            $temp.=$sitename.'/категория/'.$category->getCategoryLink()."\r\n";
        }
        unset($categories);
        $categories = papercategory::All();
        foreach ($categories as $category) {
            $temp.=$sitename.'/статьи-категории/'.$category->id."\r\n";
        }
        unset($categories);
        $articles = Article::All();
        foreach ($articles as $article) {
            $temp.=$sitename.'/купить/'.$article->getArticleLink()."\r\n";
        }
        unset($articles);
        $articles = paper::All();
        foreach ($articles as $article) {
            $temp.=$sitename.'/статья/'.$article->id."\r\n";
        }

        file_put_contents($sitemap, $temp);

        //fclose($temp);

        //return dd($sitemap,$sitename,$periods,$_SERVER);

        return redirect()->back();
    }

}
