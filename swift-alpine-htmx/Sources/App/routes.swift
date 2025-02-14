import Foundation
import Vapor

struct Todo: Content {
    var Id: Int?
    var Name: String
    var IsCompleted: Bool

    init(Id: Int? = 4, Name: String, IsCompleted: Bool) {
        self.Id = Id
        self.Name = Name
        self.IsCompleted = IsCompleted
    }
}

let todos: [Todo] = [
    Todo(Id: 1, Name: "Learn Go", IsCompleted: false),
    Todo(Id: 2, Name: "Learn Alpine", IsCompleted: false),
    Todo(Id: 3, Name: "Go to the gym", IsCompleted: true)
]

func routes(_ app: Application) throws {
    app.get { req async throws -> View in
        let todosJSON = try JSONEncoder().encode(todos)
        let todosString = String(data: todosJSON, encoding: .utf8) ?? "[]"
        return try await req.view.render("index", ["todos": todosString])
    }

   app.post("submit-todo") { req async throws -> View in
    let todo = try req.content.decode(Todo.self)
    print(todo.Id)
    return try await req.view.render("todo", Todo(Id: 4, Name: todo.Name, IsCompleted: todo.IsCompleted))
}

}
