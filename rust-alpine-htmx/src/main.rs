use actix_web::{get, middleware, post, web, App, HttpResponse, HttpServer, Responder, Result};
use askama::Template;
use std::collections::HashMap;
use serde::Serialize;

#[derive(Template)]
#[template(path = "todo.html")]
#[derive(Serialize)]
struct Todo {
    id: i32,
    name: String,
    isCompleted: bool,
}

#[derive(serde::Deserialize)]
struct NewTodo {
    name: String,
    isCompleted: Option<bool>,
}

#[derive(Template)]
#[template(path = "index.html")]
struct Index {
    todos_json: String,
}

async fn index() -> Result<impl Responder> {
    let todos: Vec<Todo> = vec![
        Todo { id: 1, name: String::from("Learn Rust"), isCompleted: false },
        Todo { id: 2, name: String::from("Build a web app"), isCompleted: false },
        Todo { id: 3, name: String::from("Build a web app again"), isCompleted: false },
    ];
     // Serialize the todos vector to a JSON string
     let todos_json = serde_json::to_string(&todos)
     .expect("Failed to serialize todos");

    let index = Index { todos_json };
    let html = index.render().expect("template should be valid");
    
    Ok(web::Html::new(html))
}

#[post("/submit-todo")]
async fn newTodo(form: web::Form<NewTodo>) -> impl Responder {

    let todo = Todo {
        id: 4, // Replace or compute id as needed.
        name: form.name.to_owned(),
        isCompleted: form.isCompleted.unwrap_or(false),
    };

   //let todo_temp = Todo { id: todo.id, name: todo.name, isCompleted: todo.isCompleted };
    let html = todo.render().expect("template should be valid");
    HttpResponse::Ok().content_type("text/html").body(html)
}

#[actix_web::main]
async fn main() -> std::io::Result<()> {

    HttpServer::new(move || {
        App::new()
            .wrap(middleware::Logger::default())
            .service(web::resource("/").route(web::get().to(index)))
            .service(newTodo)
    })
    .bind(("127.0.0.1", 8080))?
    .run()
    .await
}