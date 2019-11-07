package main

import (
	"bufio"
	"fmt"
	"github.com/PuerkitoBio/goquery"
	"io"
	"io/ioutil"
	"os"
	"path"
	"path/filepath"
	"strings"
)
// Need to be launched inside template directory.
func File(src, dst string) error {
	var err error
	var srcFile *os.File
	var dstFile *os.File
	var srcInfo os.FileInfo

	if srcFile, err = os.Open(src); err != nil {
		return err
	}
	defer srcFile.Close()

	if dstFile, err = os.Create(dst); err != nil {
		return err
	}
	defer dstFile.Close()

	if _, err = io.Copy(dstFile, srcFile); err != nil {
		return err
	}
	if srcInfo, err = os.Stat(src); err != nil {
		return err
	}
	return os.Chmod(dst, srcInfo.Mode())
}


func getCount(dir string) int {
    count :=0
    if dir == "."  {
        count = 0
	} else {
        count = strings.Count(dir, "\\") + 1
    }
    return count
}

func redirectJs(dir string) string{
    less := "../"
    start := "./"
    count := getCount(dir)
    for i := 0 ; i < count ; i++ {
        start = start + less
    }
    dir1 := strings.Replace(dir, "\\", "/", -1)
    if start == "./"{
        start = "."
    }
    finalFRURL := strings.Replace(start+"/fr/"+dir1, "//", "/", -1)
    finalENURL := strings.Replace(start+"/en/"+dir1, "//", "/", -1)
    a := `var userLang = navigator.language || navigator.userLanguage;
if(userLang.includes("FR") || userLang.includes("fr")){
    document.location.href="`+finalFRURL+`";
} else { 
    document.location.href="`+finalENURL+`";
}`
    return a
 }

func Dir(src string, dst string) error {
	var err error
	var fds []os.FileInfo
	var srcInfo os.FileInfo

	if srcInfo, err = os.Stat(src); err != nil {
		return err
	}

	if err = os.MkdirAll(dst, srcInfo.Mode()); err != nil {
		return err
	}

	if fds, err = ioutil.ReadDir(src); err != nil {
		return err
	}
	for _, fd := range fds {
		srcFilePath := path.Join(src, fd.Name())
		dstFilePath := path.Join(dst, fd.Name())

		if fd.IsDir() {
			if err = Dir(srcFilePath, dstFilePath); err != nil {
				fmt.Println(err)
			}
		} else {
			if err = File(srcFilePath, dstFilePath); err != nil {
				fmt.Println(err)
			}
		}
	}
	return nil
}

func main() {
        var dirs []string
        var files []string
        supportedLang := []string{"fr", "en"}

        root := "."
        filepath.Walk(root, func(path string, info os.FileInfo, err error) error {
            if info.IsDir() {
                dirs = append(dirs, path)
            } else {
                files = append(files, path)
            }
            return nil
        })
        for _, lang := range supportedLang {
            for _, dir := range dirs {
                os.MkdirAll("..\\..\\"+lang+"\\"+dir, os.ModePerm)
                os.MkdirAll("..\\..\\"+dir, os.ModePerm)
            }
        }
        Dir("..\\css\\", "..\\..\\css")
        Dir("..\\js\\", "..\\..\\js")
        Dir("..\\img\\", "..\\..\\img")

        Dir("..\\blog-common\\", "..\\..\\blog-common")

        for _, dir := range dirs {
            f, _ := os.Create("..\\..\\"+dir+"\\"+"index.html")

            fileContent, _ := ioutil.ReadFile("../redirict.html")
            doc, _ := goquery.NewDocumentFromReader(strings.NewReader(string(fileContent)))
            redirictJs := redirectJs(dir)
            doc.Find("script[id=\"redirection\"]").Each(func(i int, h1 *goquery.Selection) { h1.ReplaceWithHtml("<script>"+redirictJs+"</script>") })
            htmlResult, _ := doc.Html()
            w := bufio.NewWriter(f)
            w.WriteString(htmlResult)
            w.Flush()
        }

        for _, file := range files {
           strings1 := []string{"fr", "en"}
               b, err := ioutil.ReadFile(file)
               if err != nil {
                   fmt.Print(err)
               }
               fileContent := string(b)
               for _, lang := range supportedLang {
                   a := []string{"fr", "en"}
                   copy(a, strings1)
            	    for i := 0; i < len(a); i++ {
                       if a[i] == lang {
                           a = append(a[:i], a[i+1:]...)
                           i--
                       }
                   }
                   f, err := os.Create("..\\..\\"+lang+"\\"+file)
                   if err != nil {
                        fmt.Print(err)
                    }
                   doc, _ := goquery.NewDocumentFromReader(strings.NewReader(fileContent))
                   doc.Find("[plang=\""+a[0]+"\"]").Each(func(i int, h1 *goquery.Selection) { h1.Remove() })
                   htmlResult, _ := doc.Html()

                   w := bufio.NewWriter(f)
                   w.WriteString(htmlResult)
                   w.Flush()
               }
        }
}