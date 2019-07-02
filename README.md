[![License](https://img.shields.io/github/license/yonna-framework/response.svg)](https://packagist.org/packages/yonna/response)
[![Repo Size](https://img.shields.io/github/repo-size/yonna-framework/response.svg)](https://packagist.org/packages/yonna/response)
[![Downloads](https://img.shields.io/packagist/dm/yonna/response.svg)](https://packagist.org/packages/yonna/response)
[![Version](https://img.shields.io/github/release/yonna-framework/response.svg)](https://packagist.org/packages/yonna/response)
[![Php](https://img.shields.io/packagist/php-v/yonna/response.svg)](https://packagist.org/packages/yonna/response)

## Yonna response库

```
Response是一个响应组件
根据Conllector可以为你提供一系列的数据格式组装
支持 json xml text html array 等数据格式
```

## 

#### 如何安装

##### 可以通过composer安装：`composer require yonna/response`

##### 可以通过git下载：`git clone https://github.com/yonna-framework/response.git`

> Yonna demo：[GOTO yonna](https://github.com/yonna-framework/yonna)

### Example

```php
<?php
    
    use Yonna\Response\Response;
    
    // 调用Response的方法，大部分会返回一个Collector对象
    
    $collector = Response::success('请求成功');
    $collector = Response::error('请求失败');
    $collector = Response::broadcast('广播');
    $collector = Response::goon('步进请求');
    $collector = Response::notPermission('权限限制');
    $collector = Response::notFound('资源丢失');
    
    // 其中exception/abort方法在debug模式下会打印出所有的trace
    // 而在其他环境中(如正式环境)，会自动降权，只显示关键的错误提示，提升系统的安全性
    // * 根据 .env IS_DEBUG 进行判断
    
    $collector = Response::exception('抛出');
    $collector = Response::abort('中断');
    
    // 你可以使用对象的各类转换方法，获得你想要的数据格式
    
    $collector->toJson();
    $collector->toXml();
    $collector->toArray();
    $collector->toHtml();
    $collector->toText();
    
    // 可以使用handle方法获得关闭请求前的预备response数据，你也可以直接用collector来获取
    $handle = Response::handle($collector);
    $collector->response();
    
    // 可以获得对应数据应该配置的header，response/getHeader方法在一些需要分离返回请求的场景十分有用，如swoole
    $collector->getHeader();
    
    // 如果你只是一个简单的ajax服务器，那么可以直接end方法，会结束掉这一次的请求并给客户端返回相应的数据
    $collector->end();
    
?>
```
