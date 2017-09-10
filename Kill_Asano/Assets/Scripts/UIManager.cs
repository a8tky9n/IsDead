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
    string nameUrl = "http://a8tky9n.sakura.ne.jp/AsanoKill/tweettest.php";
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
    // 送信するメソッド
    public IEnumerator post()
    {
        WWW post = new WWW(url + COD);
        yield return post;
        Debug.Log(post.text);
    }

    // ボタンを押したときの処理
    void OnPushPostButton()
    {
        StartCoroutine("post");
    }

    void Update()
    {
       
    }
}
