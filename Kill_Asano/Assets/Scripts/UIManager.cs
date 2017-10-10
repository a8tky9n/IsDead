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
using System;
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
    // 名前
    string userName;

    [SerializeField]
    GUISkin style;
    [SerializeField]
    Dropdown nameList;
    [SerializeField]
    InputField nameText;
    [SerializeField]
    InputField CODText;
    // Twitterに送信するメソッド
    // PHPは?以下をすべて投稿するようになっているので注意！
    public IEnumerator post()
    {
        // Twitter投稿
        WWW post = new WWW(twitterUrl+ "?" + COD);
        yield return post;
        // DB更新
        WWW updateDB = new WWW(url + "?name=" + userName);
        yield return updateDB;
        // 死因DB更新
        WWW updateCOD = new WWW(CoDUrl + "?name=" + userName + "&reason=" + CODText.text);
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
    // 名前が入力されたときに呼ぶメソッド
    void OnNameEntered()
    {
        userName = nameText.text;
    }

    // 死因が入力されたときに呼ぶメソッド
    void OnCODEntered()
    {
        if (CODText.text == null)
        {
            COD = "msg=あさのは" + userName + "にキルされました...";
        }
        else
        {
            COD = "msg=あさのは" + CODText.text+"によって"+userName+"にキルされました...";
        }
    }

    // メソッドが2つに分かれるのが面倒だったので1つにまとめる
    // OnEndEditからはこのメソッドを呼ぶ
    public void TextChanged()
    {
        OnNameEntered();
        OnCODEntered();
        OnTextChanged();
    }
   
}
