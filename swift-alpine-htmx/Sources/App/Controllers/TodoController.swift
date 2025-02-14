// import Vapor

// struct TodoController: RouteCollection {
//     func boot(routes: RoutesBuilder) throws {
//         let todos: [Todo] = [
//             Todo(id: 1, name: "Learn Go", isCompleted: false),
//             Todo(id: 2, name: "Learn Alpine", isCompleted: false),
//             Todo(id: 3, name: "Go to the gym", isCompleted: true)
//         ]
//         todos.get(use: index)
//         todos.post(use: create)

//     }

//     func index(req: Request) async throws -> [Todo] {
//         try await Todo.query(on: req.db).all()
//     }

//     func create(req: Request) async throws -> Todo {
//         let todo = try req.content.decode(Todo.self)
//         try await todo.save(on: req.db)
//         return todo
//     }
// }