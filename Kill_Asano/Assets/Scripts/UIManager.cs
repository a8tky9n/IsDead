// 製作者 浅野 a8tky9n@gmail.com
// 
// キルをとった人と死因をTwitterに投稿しDBに保存するメソッド
// 【タスク】
// 
// 
// 
using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.UI;
public class UIManager : MonoBehaviour
{
    string COD = "死因";
    // 名前と回数を記録するDBにアクセスするためのリンク
    string url = "http://a8tky9n.sakura.ne.jp/AsanoKill/tweettest.php?";
    // 死因を記録するDBにアクセスするためのリンク
    string CoDUrl = "http://a8tky9n.sakura.ne.jp/AsanoKill/tweettest.php";
    // DBにのっている名前を回収するためのリンク
    string nameUrl = "http://a8tky9n.sakura.ne.jp/AsanoKill/GetName.php";
    // Twitter投稿用のリンク
    string twitterUrl = "http://a8tky9n.sakura.ne.jp/AsanoKill/tweettest.php";
    string msg;
    [SerializeField]
    GUISkin style;
    [SerializeField]
    Dropdown nameList;
    [SerializeField]
    InputField nameText;
    // データベースに載っている名前を更新する
    void DataUpdate()
    {

    }
    // Twitterに送信するメソッド
    // PHPは?以下をすべて投稿するようになっているので注意！
    public IEnumerator post()
    {
        // 変更予定
        WWW post = new WWW(url+ "?" + COD);
        yield return post;
        Debug.Log(post.text);
    }

    // 投稿ボタンを押したときの処理
    public void OnPushPostButton()
    {
        StartCoroutine("post");
    }

    // DBに接続し、キル履歴にある名前をとってくる(WWWを使うためコルーチン)
    // [タスク] カンマ区切りでテキストが取得できるのでウマいことやる(最後は"，")
    IEnumerator getName()
    {
        // 置き換え予定(無いとエラーが出る)
        WWW nameListPHP = new WWW(nameUrl);
        // ダウンロード完了まで待つ
        yield return nameListPHP;
        // ダウンロードしてきたデータを配列に分ける
        
    }

    // 履歴をとってくるPHPを発火するメソッド
    public void OnTextChanged()
    {
        StartCoroutine("getName");
    }
}
