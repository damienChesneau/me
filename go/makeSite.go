package main

import (
    "fmt"
    "bufio"
    "path"
    "io/ioutil"
    "io"
    "os"
    "strings"
    "github.com/PuerkitoBio/goquery"
    "path/filepath"
)
// Need to be launched inside template directory.
func File(src, dst string) error {
	var err error
	var srcfd *os.File
	var dstfd *os.File
	var srcinfo os.FileInfo

	if srcfd, err = os.Open(src); err != nil {
		return err
	}
	defer srcfd.Close()

	if dstfd, err = os.Create(dst); err != nil {
		return err
	}
	defer dstfd.Close()

	if _, err = io.Copy(dstfd, srcfd); err != nil {
		return err
	}
	if srcinfo, err = os.Stat(src); err != nil {
		return err
	}
	return os.Chmod(dst, srcinfo.Mode())
}


func getCount(dir string) int {
    count :=0
    if dir == "."  {
        count = 0;
    } else {
        count = strings.Count(dir, "\\") + 1
    }
    return count
}

func redirictJs(dir string) string{
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

func remove(s []string, r string) []string {
    for i, v := range s {
        if v == r {
            return append(s[:i], s[i+1:]...)
        }
    }
    return s
}

func listAllDir(dir string) []string {
    files, _ := filepath.Glob("*")
    return files
}

func copyAndChangeLang(filePath string){
    strings1 := []string{"fr", "en"}
    b, err := ioutil.ReadFile("template\\"+filePath)
    if err != nil {
        fmt.Print(err)
    }
    fileContent := string(b)
    for _, s := range strings1 {
        a := []string{"fr", "en"}
        copy(a, strings1)
 	    for i := 0; i < len(a); i++ {
            if a[i] == s {
                a = append(a[:i], a[i+1:]...)
                i--
            }
        }
        f, err := os.Create(".\\build\\"+s+"\\"+filePath)
        if err != nil {
             fmt.Print(err)
         }
        doc, _ := goquery.NewDocumentFromReader(strings.NewReader((fileContent)))
        doc.Find("p[lang=\""+a[0]+"\"]").Each(func(i int, h1 *goquery.Selection) { h1.Remove() })
        htmlResult, _ := doc.Html()

        w := bufio.NewWriter(f)
        w.WriteString(htmlResult)
        w.Flush()
    }
}

func Dir(src string, dst string) error {
	var err error
	var fds []os.FileInfo
	var srcinfo os.FileInfo

	if srcinfo, err = os.Stat(src); err != nil {
		return err
	}

	if err = os.MkdirAll(dst, srcinfo.Mode()); err != nil {
		return err
	}

	if fds, err = ioutil.ReadDir(src); err != nil {
		return err
	}
	for _, fd := range fds {
		srcfp := path.Join(src, fd.Name())
		dstfp := path.Join(dst, fd.Name())

		if fd.IsDir() {
			if err = Dir(srcfp, dstfp); err != nil {
				fmt.Println(err)
			}
		} else {
			if err = File(srcfp, dstfp); err != nil {
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
            doc, _ := goquery.NewDocumentFromReader(strings.NewReader((string(fileContent))))
            redirictJs := redirictJs(dir)
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
                   doc, _ := goquery.NewDocumentFromReader(strings.NewReader((fileContent)))
                   doc.Find("[plang=\""+a[0]+"\"]").Each(func(i int, h1 *goquery.Selection) { h1.Remove() })
                   htmlResult, _ := doc.Html()

                   w := bufio.NewWriter(f)
                   w.WriteString(htmlResult)
                   w.Flush()
               }
        }
}