<?php

namespace ODesk\HomeTaskBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DomCrawler\Crawler;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hometask');

        $form = $crawler->selectButton('Generate')->form(array(
            'form[word]' => 'symfonyfan',
            'form[cels]' => 3
        ));

        $crawler = $client->submit($form);
        $list = array();
        $crawler->filter('td')->each(function (Crawler $node, $i) use (&$list) {
            $list[] = $node->text();
        });

        $this->assertEquals(implode($list), 'symfafyno');
    }
}
