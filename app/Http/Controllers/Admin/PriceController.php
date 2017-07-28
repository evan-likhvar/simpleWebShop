<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
//use App\Http\Controllers\Idna_convert;
use App\Http\Controllers\Idna_convert\Idna_convert;
use App\Http\Controllers\Idna_convert\my_convert;
use App\paper;
use App\papercategory;
use App\Promotion;
use App\Repo\xmlCDATA;
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

        $converterToPuny = new my_convert();

        $xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<price>
    <date>0000</date>
    <firmName>Мой КуперХантер</firmName>
    <firmId>30653</firmId>
    <categories>
        <category>
            <id>124</id>
            <name>Бытовая техника</name>
        </category>
        <category>
            <id>171</id>
            <parentId>124</parentId>
            <name>Климатическая техника</name>
        </category>
		<category>
            <id>174</id>
            <parentId>171</parentId>
            <name>Кондиционеры</name>
        </category>
        <category>
            <id>180</id>
            <parentId>171</parentId>
            <name>Приточно-вентиляционные установки</name>
        </category>
    </categories>
    <items>
    </items>
</price>
XML;
        $hotLinePriceXML = new SimpleXMLElement($xmlstr);

        $hotLinePriceXML->date = date("Y-m-d H:i");

        $articles = Article::where('hotline','=','1')->whereIn('category_id',[2,3,10,13,14,15,17])->get();
        $categoryId = 171;
        foreach ($articles as $article) {
            $hotLinePriceXML = $this->addHotLineUaChild($hotLinePriceXML,$article, $categoryId,$converterToPuny);
        }
        $articles = Article::where('hotline','=','1')->whereIn('category_id',[4])->get();
        $categoryId = 180;
        foreach ($articles as $article) {
            $hotLinePriceXML = $this->addHotLineUaChild($hotLinePriceXML,$article, $categoryId,$converterToPuny);
        }
        $path = public_path().'/XML/hotLinePrice.xml';
        fclose(fopen($path, "a+t"));
        $fnewsmap = fopen($path, "w+t");
        flock($fnewsmap, LOCK_EX);

        fwrite($fnewsmap, $hotLinePriceXML->asXML());
        fclose($fnewsmap);
        $this->hotLinePromoXML();
        return redirect()->back();
    }
    private function addHotLineUaChild($hotLinePriceXML,$article, $categoryId,$converterToPuny){
        $item = $hotLinePriceXML->items->addChild('item');
        $item->addChild('id', $article->id);
        $item->addChild('categoryId', $categoryId);
        if (isset($article->nomer)&&!empty($article->nomer)) {
            $item->addChild('code', $article->nomer);
        }
        $item->addChild('vendor', str_replace('&','&amp;',$article->Vendor->name));
        $item->addChild('name', str_replace('&','&amp;',$article->name));
        $item->addChild('description', str_replace('&','&amp;',$article->name));
        $item->addChild('url', 'http://www.куперхантер.укр/купить/'.str_replace('&','&amp;',$article->getArticleLink()));



        //$item->addChild('url2', $converterToPuny->encode('http://www.куперхантер.укр/купить/'.str_replace('&','&amp;',$article->getArticleLink())));

        $item->addChild('image', "http://www.xn--80ajbrrjidqez.xn--j1amh".$article->getIntroImg('M'));
        $item->addChild('priceRUAH', $article->priceGRN);
        $item->addChild('stock', 'В наличии');
        return $hotLinePriceXML;
    }
    public function priceUAPriceXML()
    {
        $xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<price date="2008-09-19 12:55">
<name>Куперхантер.укр</name>
<catalog>
	<category id="1">Бытовая техника</category>
	<category id="10" parentID="1">Климатическое оборудование</category>
	<category id="100" parentID="10">Кондиционеры, увлажнители, воздухоочистители</category>
	<category id="110" parentID="100">Кондиционеры</category>
	<category id="200" parentID="10">Вентиляционное оборудование</category>
	<category id="210" parentID="200">Вентиляция</category>
</catalog>
<items>
</items>
</price>
XML;
        $hotLinePriceXML = new SimpleXMLElement($xmlstr);

        $date = $hotLinePriceXML->attributes();
        $date['date'] = date("Y-m-d H:i");


        $articles = Article::where('priceua','=','1')->whereIn('category_id',[2,3,10,13,14,15,17])->get();
        $categoryId = 110;
        foreach ($articles as $article) {
            $hotLinePriceXML = $this->addPriceUaChild($hotLinePriceXML,$article, $categoryId);
        }
        unset($articles);
        $articles = Article::where('priceua','=','1')->whereIn('category_id',[4])->get();
        $categoryId = 210;
        foreach ($articles as $article) {
            $hotLinePriceXML = $this->addPriceUaChild($hotLinePriceXML,$article, $categoryId);
        }
        $path = public_path().'/XML/priceUA.xml';
        fclose(fopen($path, "a+t"));
        $fnewsmap = fopen($path, "w+t");
        flock($fnewsmap, LOCK_EX);

        fwrite($fnewsmap, $hotLinePriceXML->asXML());
        fclose($fnewsmap);


        return redirect()->back();
    }

    private function addPriceUaChild($hotLinePriceXML,$article, $categoryId){
        $item = $hotLinePriceXML->items->addChild('item');
        $item['id'] = $article->id;
        //  $item->addChild('id', $article->id);
        $item->addChild('name', str_replace('&','&amp;',$article->name));
        $item->addChild('categoryId', $categoryId);
        $item->addChild('priceRUAH', $article->priceGRN);
        $item->addChild('url', 'http://www.куперхантер.укр/купить/'.str_replace('&','&amp;',$article->getArticleLink()));
        $item->addChild('image', "http://www.куперхантер.укр".$article->getIntroImg('M'));
        $item->addChild('vendor', str_replace('&','&amp;',$article->Vendor->name));
        $item->addChild('description', str_replace('&','&amp;', strip_tags( $article->description)));
        return $hotLinePriceXML;
    }

    public function createSiteMap()
    {
        $sitemap = public_path().'/sitemap.txt';

        $sitename = "http://www.куперхантер.укр";
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


        return redirect()->back();
    }

    public function hotLinePromoXML()
    {
        $xmlstr = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<sales>

</sales>
XML;
        $hotLinePromoXML = new xmlCDATA($xmlstr);

        //$hotLinePriceXML->date = date("Y-m-d H:i");

        $promotions = Promotion::where('is_published','=','1')->get();


        foreach ($promotions as $promotion) {

            if(count($promotion->Articles)){

                $item = $hotLinePromoXML->addChild('sale');

                $item->title = NULL; // VERY IMPORTANT! We need a node where to append
                $item->title->addCData($promotion->name);

                $item->description = NULL; // VERY IMPORTANT! We need a node where to append
                $item->description->addCData(strip_tags($promotion->intro));

                $item->url = NULL; // VERY IMPORTANT! We need a node where to append
                $item->url->addCData(route('showPromotion', ['promotion' => $promotion->id]));

                $item->date_start = NULL; // VERY IMPORTANT! We need a node where to append
                $item->date_start->addCData($promotion->promo_start);

                $item->date_end = NULL; // VERY IMPORTANT! We need a node where to append
                $item->date_end->addCData($promotion->promo_stop);

                //$title = $item->addChild('title');
                //$item->title = '<ethgtgrt>';//$this->cdata($promotion->name);

                //$item->addChild('description',$this->cdata(strip_tags($promotion->intro)));
                //$item->addChild('url',$this->cdata(route('showPromotion', ['promotion' => $promotion->id])));
                //$item->addChild('image',);
                //$item->addChild('date_start',$this->cdata($promotion->promo_start));
                //$item->addChild('date_end',$this->cdata($promotion->promo_stop));
                //$item->addChild('type',);
                $promoProducts = $item->addChild('products');
                foreach ($promotion->Articles as $article){


                    $promoProducts->product = NULL; // VERY IMPORTANT! We need a node where to append
                    $promoProducts->product->addCData('http://www.куперхантер.укр/купить/'.str_replace('&','&amp;',$article->getArticleLink()));
                    //$product = $promoProducts->addChild('product',$this->cdata('http://www.куперхантер.укр/купить/'.str_replace('&','&amp;',$article->getArticleLink())));
                    $promoProducts->product['id'] = $article->id;
                    //$product['id'] = $article->id;

                }
            }
        }

        $path = public_path().'/XML/hotLinePromo.xml';
        fclose(fopen($path, "a+t"));
        $fnewsmap = fopen($path, "w+t");
        flock($fnewsmap, LOCK_EX);

        fwrite($fnewsmap, $hotLinePromoXML->asXML());
        fclose($fnewsmap);

        return;
    }

    private function cdata($str){
        return '<![CDATA['.$str.']]>';
    }

}
