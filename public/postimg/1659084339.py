from flask import Flask, render_template, request, redirect, url_for
import sqlite3
app = Flask(__name__)


@app.route("/", methods = ["GET", "POST"])
def index():
    msg = ""
    row = ""
    if(request.method == "POST"):
        name = request.form["name"]
        course = request.form["course"]
        fees = request.form["fees"]
        conn = sqlite3.connect("stu.db")
        c = conn.cursor()
        c.execute("INSERT INTO student VALUES('"+name+"', '"+course+"', '"+fees+"')")
        msg = "Your Record Is Inserted"

        conn.commit()
        conn.close()

    return render_template("index.html", msg = msg, row = row)

@app.route("/display")
def display():
    row = ""
    conn = sqlite3.connect("stu.db")
    c = conn.cursor()
    c.execute("SELECT * FROM student")
    row = c.fetchall()

    conn.commit()
    conn.close()
    return render_template("index.html", row=row)

@app.route("/delete/<string:name>/")
def delete(name):
    name=name
    conn = sqlite3.connect("stu.db")
    c = conn.cursor()
    c.execute("SELECT * FROM student WHERE name = '"+name+"'")
    row = c.fetchall()
    conn.commit()
    conn.close()

    return render_template("delete.html", name=name)

@app.route("/edit/<string:name>/")
def edit(name):
    name=name
    conn = sqlite3.connect("stu.db")
    c = conn.cursor()
    c.execute("SELECT * FROM student WHERE name = '"+name+"'")
    row = c.fetchall()
    conn.commit()
    conn.close()
    return render_template("edit.html", name=name, row = row)


if __name__ == "__main__":
    app.run(debug=True)
