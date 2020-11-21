<?php 

namespace Tasofen;

class Pagination {

    protected $options = [
        'showPages' => 11,
        'url' => '?page=%s',

        'firstText' => '&lt;&lt;',
        'lastText' => '&gt;&gt;',
        'prevText' => '&lt;',
        'nextText' => '&gt;',

        'first' => true,
        'last' => true,
        'prev' => true,
        'next' => true,
    ];
    
    protected $templates = [
        'bootstrap' => [
            'listTag' => 'ul',
            'listClass' => 'pagination',
            'itemWrap' => 'li',
            'itemClass' => 'page-item',
            'linkClass' => 'page-link',
            'activeClass' => 'active',
        ],
        'materialize' => [
            'listTag' => 'ul',
            'listClass' => 'pagination',
            'itemWrap' => 'li',
            'itemClass' => 'waves-effect',
            'linkClass' => '',
            'activeClass' => 'active',
        ],

        'default' => [
            'listTag' => 'ul',
            'listClass' => 'pagination',
            'itemWrap' => 'li',
            'itemClass' => 'page-item waves-effect',
            'linkClass' => 'page-link',
            'activeClass' => 'active',
        ],
    ];

    public function __construct($options = [])
    {
        $this->options = array_merge($this->options, $this->templates['default'], $options);

        if (isset($options['templateName'])) {
            $this->setTemplate($options['templateName']);
        }
    }

    public function generateData($currenPage, $totalPages) {
        $arr = [];

        if ($this->options['first']) {
            $arr[] = [
                'url' => sprintf($this->options['url'], 1),
                'text' => $this->options['firstText'],
                'active' => false,
            ];
        }

        if ($this->options['prev']) {
            $arr[] = [
                'url' => sprintf($this->options['url'], max(1, $currenPage-1)),
                'text' => $this->options['prevText'],
                'active' => false,
            ];
        }

        $pages = $this->options['showPages'] - 1;
        $startPage = max(1, $currenPage - ceil($pages/2) );
        $endPage = min($totalPages, $startPage + $pages);
        $startPage = max(1, $endPage - $pages);


        for($i=$startPage;$i<=$endPage;$i++) {
            $arr[] = [
                'url' => sprintf($this->options['url'], $i),
                'text' => $i,
                'active' => $i==$currenPage,
            ];
        }


        if ($this->options['next']) {
            $arr[] = [
                'url' => sprintf($this->options['url'], min($totalPages, $currenPage+1)),
                'text' => $this->options['nextText'],
                'active' => false,
            ];
        }

        if ($this->options['last']) {
            $arr[] = [
                'url' => sprintf($this->options['url'], $totalPages),
                'text' => $this->options['lastText'],
                'active' => false,
            ];
        }

        return $arr;
    }

    public function getHtml($currenPage, $totalPages) {
        if ($this->options['listClass']) {
            $class = ' class="'.$this->options['listClass'].'"';
        } else {
            $class = '';
        }
        
        $html = '<'.$this->options['listTag'].$class.'>';

        $list = $this->generateData($currenPage, $totalPages);

        foreach($list as $item) {
            if ($this->options['itemWrap']) { 
                $class = [];

                if ($item['active']) {
                    $class[] = $this->options['activeClass'];
                }
                
                if ($this->options['itemClass']) {
                    $class[] = $this->options['itemClass'];
                }

                $class = ' class="'.implode(' ', $class).'"';
                $html .= '<'.$this->options['itemWrap'].$class.'>';
            }

            $class = [];
            if ($item['active']) {
                $class[] = $this->options['activeClass'];
            }
            if ($this->options['linkClass']) {
                $class[] = $this->options['linkClass'];
            }
            $class = implode(' ', $class);

            $html .= '<a href="'.$item['url'].'" class="'.$class.'">';
            $html .= $item['text'];
            $html .= '</a>';

            if ($this->options['itemWrap']) {
                $html .= '</'.$this->options['itemWrap'].'>';
            }
        }

        $html .= '</'.$this->options['listTag'].'>';
        return $html;
    }

    public function getArray($currenPage, $totalPages) {
        return $this->generateData($currenPage, $totalPages);
    }

    public function getJSON($currenPage, $totalPages) {
        return json_encode($this->generateData($currenPage, $totalPages));
    }

    public function addTemplate($templateName, $options = []) {
        $this->templates[$templateName] = $options;
    }

    public function setTemplate($templateName) {
        if (isset($this->templates[$templateName])) {
        }
    }
}
