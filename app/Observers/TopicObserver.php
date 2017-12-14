<?php

namespace App\Observers;

use App\Models\Topic;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

// Eloquent 模型会触发许多事件（Event），
// 我们可以对模型的生命周期内多个时间点进行监控： creating, created, updating, updated,
// saving, saved, deleting, deleted, restoring, restored。
// 事件让你每当有特定的模型类在数据库保存或更新时，执行代码。
// 当一个新模型被初次保存将会触发 creating 以及 created 事件。
// 如果一个模型已经存在于数据库且调用了 save 方法，将会触发 updating 和 updated 事件。
// 在这两种情况下都会触发 saving 和 saved 事件。

// Eloquent 观察器允许我们对给定模型中进行事件监控，观察者类里的方法名对应 Eloquent 想监听的事件。
// 每种方法接收 model 作为其唯一的参数。代码生成器已经为我们生成了一个观察器文件，
// 并在 AppServiceProvider 中注册。
// 接下来我们要定制此观察器，在 Topic 模型保存时触发的 saving 事件中，对 excerpt 字段进行赋值：

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        // make_excerpt() 是我们自定义的辅助方法，我们需要在 helpers.php 文件中添加：
       $topic->excerpt = make_excerpt($topic->body);
    }
}
