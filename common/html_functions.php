<?php
    //  Display HTML Top
    function show_top($heading="★学生一覧★") {
        echo <<<STUDENT_LIST
        <html>
            <head>
                <title>♡学生リスト♡</title>
            </head>
        <body>
            <h1>{$heading}</h1>
        STUDENT_LIST;
    }
    //  Display HTML Bottom
    function show_bottom($return_top=false) {
        //  if $return_top is true, add a link back to the top
        if ($return_top == true) {
            echo <<<BACK_TOP
                <br>
                <br>
                <a href="index.php"><  学生一覧に戻る</a>
            BACK_TOP;
        }
        echo <<<BOTTOM
            </body>
        </html>
        BOTTOM;
    }
    //  Display Input Form
    function show_input() {
        $error = get_error();
        show_edit_input_common("", "" ,-1, "", "create", "登録");    
    }
    //  Display Delete Form
    function show_delete($member) {
        if($member != null) {
            show_student($member);
        }
        $error = "";
        $error = get_error();
        echo <<<DELETE
            <form action="post_data.php" method="post">
                <p>この情報を削除しますか？</p>
                <p>{$error}</p> 
                <input type="hidden" name="id" value="{$member["id"]}"/>
                <input type="hidden" name="data" value="delete"/>
                <br>
                <br>
                <input type="submit" value="削除">
            </form>
        DELETE;        
    }
    //  Display Update Form
    function show_update($id, $name, $grade, $old_id) {
        show_edit_input_common($id, $name, $grade, $old_id, "update", "更新");
    }
    //  Display Insert Form, Update Form
    function show_edit_input_common($id, $name, $grade, $old_id, $data, $button){
        $error = "";
        $error = get_error();
        //  Show Top of Form
        echo <<<INPUT_TOP
        <form action="post_data.php" method="post">
            <p>学生番号</p>
            <input type="text" name="id" placeholder="例）1001" value="{$id}">
            <p>名前</p>
            <input type="text" name="name" placeholder="例）山田太郎" value="{$name}">
            <p>学年</p>
            <select name="grade">
        INPUT_TOP;
        //  Display option tag(add selected to selected item)
        for($i = 1; $i <= 3; $i++){
            echo "<option value=\"{$i}\"";
            if($i == $grade){
                echo " selected ";
            }
            echo ">";
            echo $i;
            echo "</option>";
        }
        //  Show Bottom of Form
        echo <<<INPUT_BOTTOM
            </select>
            <p>{$error}</p>
            <input type="hidden" name="old_id" value="{$old_id}">
            <input type="hidden" name="data" value="{$data}">
            <br>
            <br>
            <input type="submit" value="{$button}">
        </form>
        INPUT_BOTTOM;        
    }
    //  Display Student List
    function show_student_list($member){
        //  Show Top of Table
        echo <<<TABLE_TOP
        <table border="1" style="border-collapse:collapse">
            <tr>
                <th>学生番号</th><th width="100px">名前</th><th>学年</th>
            </tr>
        TABLE_TOP;
        foreach($member as $loop){
            //  View data in heredocs
            echo <<<END
                    <tr align="center">
                        <td>{$loop["id"]}</td>
                        <td><a href="student_edit.php?id={$loop["id"]}">{$loop["name"]}</a></td>
                        <td>{$loop["grade"]}</td>
                    </tr>
            
            END;
        }
        //  Show Bottom of Table
        echo <<<TABLE_BOTTOM
        </table>
        <br>
        TABLE_BOTTOM;
    }
    //  View Specific Student Information
    function show_student($member){
        //  Show Top of Table
        echo <<<STUDENT
        <table border="1" style="border-collapse:collapse">
            <tr>
                <th>学生番号</th><th width="100px">名前</th><th>学年</th>
            </tr>
            <tr align="center">
                <td>{$member["id"]}</td>
                <td>{$member["name"]}</td>
                <td>{$member["grade"]}</td>
            </tr>
        </table>
        <br>
        STUDENT;
    }
    //  Displaying a list of Operations on the Editing Screen
    function show_operations($id){
        echo <<<OPERATIONS
        <a href="student_update.php?id={$id}">情報の更新</a>
            <br>
        <a href="student_delete.php?id={$id}">情報の削除</a>
    OPERATIONS;
    }

?>