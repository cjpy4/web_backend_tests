import Foundation

extension Foundation.Bundle {
    static let module: Bundle = {
        let mainPath = Bundle.main.bundleURL.appendingPathComponent("swift-crypto__CryptoExtras.bundle").path
        let buildPath = "/Users/cjpye/Code/Projects/alpine_todo/swift-alpine-htmx/.build/arm64-apple-macosx/debug/swift-crypto__CryptoExtras.bundle"

        let preferredBundle = Bundle(path: mainPath)

        guard let bundle = preferredBundle ?? Bundle(path: buildPath) else {
            // Users can write a function called fatalError themselves, we should be resilient against that.
            Swift.fatalError("could not load resource bundle: from \(mainPath) or \(buildPath)")
        }

        return bundle
    }()
}