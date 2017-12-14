<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**表单请求验证（FormRequest）的工作机制，是利用 Laravel 提供的依赖注入功能，
    在控制器方法，如上面我们的 update() 方法声明中，传参 UserRequest。
    这将触发表单请求类的自动验证机制，验证发生在 UserRequest 中，
    并使用此文件中方法 rules() 定制的规则，只有当验证通过时，
    才会执行 控制器 update()
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

//name.required —— 验证的字段必须存在于输入数据中，而不是空。详见文档
// name.between —— 验证的字段的大小必须在给定的 min 和 max 之间。详见文档
// name.regex —— 验证的字段必须与给定的正则表达式匹配。详见文档
// name.unique —— 验证的字段在给定的数据库表中必须是唯一的。详见文档
// email.required —— 同上
// email.email —— 验证的字段必须符合 e-mail 地址格式。详见文档
// introduction.max —— 验证中的字段必须小于或等于 value。详见文档
        return [
               'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
               'email' => 'required|email',
               'introduction' => 'max:80',
           ];
    }


    // messages() 方法是 表单请求验证（FormRequest）一个很方便的功能，允许我们自定义具体的消息提醒内容，键值的命名规范 —— 字段名 + 规则名称，对应的是消息提醒的内容。效果如下：
    public function messages()
    {
       return [
           'name.unique' => '用户名已被占用，请重新填写',
           'name.regex' => '用户名只支持中英文、数字、横杆和下划线。',
           'name.between' => '用户名必须介于 3 - 25 个字符之间。',
           'name.required' => '用户名不能为空。',
       ];
    }
}